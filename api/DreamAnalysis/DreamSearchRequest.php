<?php


namespace app\api\DreamAnalysis;


class DreamSearchRequest
{
	public $user_id;
	public $search_text;
	public $page;
	public $limit;
	public $api = 'search';
}