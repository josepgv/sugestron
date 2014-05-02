<?php
namespace Suggestotron\Model;

class Topics {

    public function getAllTopics()
    {
        $query = \Suggestotron\Db::getInstance()->prepare(
            "SELECT topics.*, votes.count
            FROM topics INNER JOIN votes
            ON (topics.id = votes.topic_id)
            ORDER BY
            votes.count DESC, topics.title ASC"
        );
        $query->execute();

        return $query;
    }

    public function getTopic($id)
	{
		$sql = "SELECT * FROM topics WHERE id = :id LIMIT 1";
		$query = \Suggestotron\Db::getInstance()->prepare($sql);

		$values = [':id' => $id];
		$query->execute($values);

		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	public function add($data)
	{
	    $query = \Suggestotron\Db::getInstance()->prepare(
	        "INSERT INTO topics (
	            title,
	            description
	        ) VALUES (
	            :title,
	            :description
	        )"
	    );

	    $data = [
	        ':title' => $data['title'],
	        ':description' => $data['description']
	    ];

	    $query->execute($data);

        $lastId = \Suggestotron\Db::getInstance()->lastInsertId();
        $query = \Suggestotron\Db::getInstance()->prepare(
            "
            INSERT INTO votes (
                topic_id,
                count
            )
            VALUES (
                :id,
                0
            )
            "
        );
        $data = [':id' => $lastId];

        $query->execute($data);
	}

	public function update($data)
	{
	    $query = \Suggestotron\Db::getInstance()->prepare(
	        "UPDATE topics 
	            SET 
	                title = :title, 
	                description = :description
	            WHERE
	                id = :id"
	    );

	    $data = [
	        ':id' => $data['id'],
	        ':title' => $data['title'],
	        ':description' => $data['description']
	    ];

	    return $query->execute($data);
	}

	public function delete($id) {
	    $query = \Suggestotron\Db::getInstance()->prepare(
	        "DELETE FROM topics
	            WHERE
	                id = :id"
	    );

	    $data = [
	        ':id' => $id,
	    ];

	    return $query->execute($data);

        $query = \Suggestotron\Db::getInstance()->prepare(
            " DELETE FROM votes WHERE id = :id"
        );
        $data = [':id' => $id]; // not really needed because it's defined before but kept for clarity
        $query->execute($data);

	}
}
?>
