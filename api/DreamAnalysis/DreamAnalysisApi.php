<?php

namespace app\api\DreamAnalysis;

use Socket\Raw\Factory;
use Socket\Raw\Socket;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class DreamAnalysisApi
{
	const ADDRESS = '127.0.0.1';
	const PORT = 1995;

	/** @var  string $address API server address */
	protected $address;

	/** @var  int $port API port */
	protected $port;

	public function __construct(string $address = self::ADDRESS, int $port = self::PORT)
	{
		$this->address = $address;
		$this->port = $port;
	}

	/**
	 * Searches for dreams.
	 *
	 * @param DreamSearchRequest $request
	 * @return DreamSearchResponse
	 */
	public function search(DreamSearchRequest $request): DreamSearchResponse
	{
		$response = new DreamSearchResponse();
		try
		{
			$responseData = $this->makeRequest($request);

			$response->code = intval($responseData->code ?? -1);
			$response->error = $responseData->error ?? NULL;
			$data = $responseData->data ?? [];
			$dreamResults = $data->results ?? [];
			$response->total = $data->total ?? NULL;

			foreach($dreamResults as $dreamResult)
			{
				$dreamId = $dreamResult->id ?? '';
				$dreamFrequency = $dreamResult->frequency ?? '';

				if($dreamId && $dreamFrequency)
				{
					$dreamSearchResult = new DreamSearchResult();
					$dreamSearchResult->dreamId = $dreamId;
					$dreamSearchResult->frequency = $dreamFrequency;
					$response->results[] = $dreamSearchResult;
				}
			}
		}
		catch(\Exception $e)
		{
			$response->code = 400;
			$response->error = $e->getMessage();
		}

		return $response;
	}

	/**
	 * Adds a word to the DB processing with NLTK
	 * to ensure it is in the correct format.
	 *
	 * @param AddWordRequest $request
	 * @return AddWordResponse
	 */
	public function addWord(AddWordRequest $request): AddWordResponse
	{
		$response = new AddWordResponse();
		try
		{
			$responseData = $this->makeRequest($request);
			$response->code = intval($responseData->code ?? -1);
			$response->error = $responseData->error ?? NULL;
			$response->word = $responseData->data ?? NULL;
		}
		catch(\Exception $e)
		{
			$response->code = 400;
			$response->error = $e->getMessage();
		}

		return $response;
	}

	/**
	 * Makes a generic request.
	 *
	 * @param $request
	 * @return object
	 * @throws BadRequestHttpException
	 */
	protected function makeRequest($request): object
	{
		$conn = $this->getConnection();
		try
		{
			$jsonData = json_encode($request, JSON_PRETTY_PRINT);
			if(!$conn->write($jsonData))
			{
				throw new BadRequestHttpException('Failed to send request to DreamAnalysis API.');
			}

			$responseData = '';
			//Read data in 8k chunks (why this number? who knows)
			while($bytes = $conn->read(8192))
			{
				$responseData .= $bytes;
			}

			if(!$responseData)
			{
				throw new BadRequestHttpException('Failed to receive response from DreamAnalysis API.');
			}

			$responseData = json_decode($responseData);
			if($responseData === false)
			{
				throw new BadRequestHttpException('Invalid response from DreamAnalysis API.');
			}
		}
		catch(\Exception $e)
		{
			$conn->close();
			throw $e;
		}

		$conn->close();
		return $responseData;
	}

	/**
	 * Gets the socket connection for the API.
	 *
	 * @return Socket
	 * @throws NotFoundHttpException
	 */
	protected function getConnection(): Socket
	{
		$address = $this->address . ':' . $this->port;
		try
		{
			$factory = new Factory();
			return $factory->createClient($address);
		}
		catch(\Exception $e)
		{
			throw new NotFoundHttpException('Failed to connect to DreamAnalysis API on ' . $address . '.');
		}
	}
}