<?php


namespace app\api\DreamAnalysis;


class DreamSearchResult
{
	/** @var  string $dreamId The dream ID in formatted UUID format. */
	public $dreamId;

	/** @var  float $frequency The total frequency of matched words, summed. Unknown range. */
	public $frequency;
}