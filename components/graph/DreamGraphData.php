<?php

namespace app\components\graph;

class DreamGraphData
{
	/**
	 * Gets all dream counts on each day of the week for analysis/charts.
	 *
	 * @return array
	 */
	public function getDreamCountByDayOfWeek(int $userId = NULL): array
	{
		$sql = "
			SELECT
				DAYNAME(dream.dreamt_at) AS 'day_of_week',
				COUNT(dream.id) AS 'count'
			FROM
				dj.dream dream
			GROUP BY
				DAYNAME(dream.dreamt_at)
			ORDER BY
				DAYOFWEEK(dream.dreamt_at) ASC
			;
		";
		$dreamCountData = \Yii::$app->getDb()->createCommand($sql)->queryAll();
		$dreamCountDataByDay = [];
		foreach($dreamCountData as $row)
		{
			$dreamCountDataByDay[$row['day_of_week']] = $row['count'];
		}
		return $dreamCountDataByDay;
	}

	/**
	 * Gets all dream counts on each day of the week for analysis/charts.
	 *
	 * @return array
	 */
	public function getDreamCountByMonth(int $userId = NULL): array
	{
		$sql = "
			SELECT
				CONCAT(MONTHNAME(dream.dreamt_at), ', ', YEAR(dream.dreamt_at)) AS 'year-month',
				COUNT(dream.id) AS 'count'
			FROM
				dj.dream dream
			GROUP BY
				YEAR(dream.dreamt_at), MONTHNAME(dream.dreamt_at)
			ORDER BY
				YEAR(dream.dreamt_at), MONTH(dream.dreamt_at) ASC
			;
		";
		$dreamCountData = \Yii::$app->getDb()->createCommand($sql)->queryAll();
		$dreamCountDataByDay = [];
		foreach($dreamCountData as $row)
		{
			$dreamCountDataByDay[$row['year-month']] = $row['count'];
		}
		return $dreamCountDataByDay;
	}

	public function getDreamCountByCategory(int $userId = null): array
	{
		$sql = "
			SELECT
				cat.name AS 'name',
				COUNT(dream.id) AS 'count'
			FROM
				dj.dream dream
			INNER JOIN
				dj.dream_to_dream_category d2cat ON d2cat.dream_id = dream.id
			INNER JOIN
				dj.dream_category cat ON cat.id = d2cat.category_id
			GROUP BY
				cat.id
			ORDER BY
				cat.name ASC
			;
		";
		$dreamCountData = \Yii::$app->getDb()->createCommand($sql)->queryAll();
		$dreamCountDataByDay = [];
		foreach($dreamCountData as $row)
		{
			$dreamCountDataByDay[$row['name']] = $row['count'];
		}
		return $dreamCountDataByDay;
	}
}