<?php 
namespace Gui\AluraPlay\Model;


class Video{
    private ?int $id;
    private string $url;
    private string $title;
    private ?string $filePath = null;

    public function __construct(?int $id,string $url, string $title) {
        $this->id=$id;
        $this->url = $url;
        $this->title = $title;
    }

    public function getUrl():string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFilePath(string $filePath): void{
        $this->filePath = $filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

}


?>