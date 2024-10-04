<?php 

namespace Gui\AluraPlay\Repository;
use PDO;
use Gui\AluraPlay\Model\Video;

class VideoRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addVideo(Video $video):Video
    {
        $stmt = $this->pdo->prepare('INSERT INTO videos (url,title,image_path,user_id ) VALUES (?,?,?,?)');
        $stmt->bindValue(1,$video->getUrl());
        $stmt->bindValue(2,$video->getTitle());
        $stmt->bindValue(3,$video->getFilePath());
        $stmt->bindValue(4,$_SESSION['user_id']);
        $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $video->setId(intval($id));
        return $video;
        
    }

    public function getVideosFromDB(): array{
        $user_id = $_SESSION['user_id'];
        $stmt = $this->pdo->query("SELECT * FROM videos WHERE user_id=$user_id");
        $videos = $stmt->fetchAll();
        
        return array_map(function($video){return $this->hydrateVideo($video);},$videos);
    }


    public function deleteVideoFromDB(int $id):bool{
        $deleteCover = $this->deleteVideoCover($id);
        $stmt = $this->pdo->prepare('DELETE FROM videos WHERE id=?');
        $stmt->bindValue(1,$id);
        return $stmt->execute();
    }

    public function getOneVideo(int $id): Video
    {
        $stmt= $this->pdo->prepare('SELECT * FROM videos WHERE id= ?;');
        $stmt->bindValue(1,$id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->hydrateVideo($stmt->fetch());
    }

    public function hydrateVideo(array $videoData):Video{
        $video = new Video($videoData['id'],$videoData['url'],$videoData['title']);
        if($videoData['image_path']!==null){
            $video->setFilePath($videoData['image_path']);
        }
        
        return $video;

    }
    public function updateVideo(Video $video):bool
    {
        
        $updateImageSql = '';
        if($video->getFilePath() !== null){
            $updateImageSql = ',image_path = :image_path'; 
        }
        $stmt = $this->pdo->prepare("UPDATE videos SET url = :url, title = :title $updateImageSql WHERE id = :id;");
        $stmt -> bindValue(':url',$video->getUrl());
        $stmt -> bindValue(':title',$video->getTitle());
        $stmt ->bindValue(':id',$video->getId(),PDO::PARAM_INT);
        
        if($video->getFilePath() !==null){
            $stmt -> bindValue(':image_path',$video->getFilePath());
        }

        
        return $stmt->execute();
    }

    public function deleteVideoCover(int $id)
    {
        $video = $this->getOneVideo($id);
        $coverPath = $video->getFilePath();
        unlink(__DIR__."/../../public/img/uploads/$coverPath");
        $stmt = $this->pdo->prepare("UPDATE videos SET image_path = NULL WHERE id = ?;");
        $stmt ->bindValue(1,$id,PDO::PARAM_INT);
        return $stmt ->execute();
    }
}



?>