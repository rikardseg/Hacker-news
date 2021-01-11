<?php

declare(strict_types=1);

function numberOfComments($dbHandler, $postsId): string
{
    // Sql statment that selects the number of rows in table comments.
    $sql = "SELECT COUNT(*) FROM comments WHERE posts_id=:posts_id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':posts_id', $postsId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchColumn();
    return $comments;
}

function addVote($dbHandler, $user, $postsId): bool
{
    // Add record in user_vote to mark that user has voted
    $time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO user_vote (user, posts_id, time_stamp) VALUES (:user, :posts_id, :time_stamp)";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->bindParam(':posts_id', $postsId, PDO::PARAM_INT);
    $statement->bindParam(':time_stamp', $time, PDO::PARAM_STR);
    $statement->execute();

    return TRUE;
}

function removeVote($dbHandler, $user, $postsId): bool
{
    // Remove record in user_vote to mark that user has removed the vote
    $sql = "DELETE FROM user_vote WHERE user=:user AND posts_id=:posts_id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->bindParam(':posts_id', $postsId, PDO::PARAM_INT);
    $statement->execute();

    return TRUE;
}

function userHasVoted($dbHandler, $user, $postsId): bool
{
    // Check if user has already voted, meaning that post exist in user_vote
    $sql = "SELECT COUNT(*) FROM user_vote WHERE user=:user AND posts_id=:posts_id";

    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':posts_id', $postsId, PDO::PARAM_INT);
    $statement->bindParam(':user', $user, PDO::PARAM_STR);
    $statement->execute();
    $rowExist = $statement->fetchColumn();  // Return number of rows/records in table

    if ($rowExist) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function updateVotes($dbHandler, $user, $postsId): bool
{
    $voteChange = 0;

    // Check if user already has voted on the post.
    $userHasVoted = userHasVoted($dbHandler, $user, $postsId);

    if ($userHasVoted === TRUE) {     // If user already has voted ==> remove that vote on post
        $voteChange = -1;
    } else {                    // If user has not voted ==> add vote on post
        $voteChange = +1;
    }

    $sql = "SELECT votes FROM posts WHERE id=:id";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':id', $postsId, PDO::PARAM_INT);
    $statement->execute();

    // Change value of votes and then update post record
    $currentVote = $statement->fetchColumn();

    $currentVote += $voteChange;

    $sql = "UPDATE posts SET votes=:votes  WHERE id=:id ";
    $statement = $dbHandler->prepare($sql);
    $statement->bindParam(':votes', $currentVote, PDO::PARAM_INT);
    $statement->bindParam(':id', $postsId, PDO::PARAM_INT);
    $statement->execute();

    if ($voteChange === 1) {
        addVote($dbHandler, $user, $postsId);
    } else if ($voteChange === -1) {
        removeVote($dbHandler, $user, $postsId);
    }
    return TRUE;
}
