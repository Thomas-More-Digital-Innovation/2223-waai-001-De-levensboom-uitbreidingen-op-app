<?php

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class Cloudinary{
    
    private $cloudName;
    private $apiKey;
    private $apiSecret;

    public $imageFile;
    public $public_id;

    public function __construct(){
        $this->getEnv();
        $this->cloudName= $_ENV['CLOUDINARY_CLOUD_NAME'];
        $this->apiKey= $_ENV['CLOUDINARY_API_KEY'];
        $this->apiSecret= $_ENV['CLOUDINARY_API_SECRET'];
    }

    private function getEnv(){
        $currentDir = __DIR__;
        $apiPos = strpos($currentDir,"api");
        $rootDir = substr($currentDir, 0, $apiPos);
        $wantedSubDir = 'vendor/autoload.php';
        $wantedRequireDir = $rootDir . $wantedSubDir;
        require($wantedRequireDir);

        $dotenv = Dotenv\Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }


    public function upload(){

        //configure 
        $config = Configuration::instance();
        $config->cloud->cloudName = $this->cloudName;
        $config->cloud->apiKey = $this->apiKey;
        $config->cloud->apiSecret = $this->apiSecret;
        $config->url->secure = true;

        $resonse = (new UploadApi())->upload($this->imageFile,[
            'public_id' => $this->public_id
        ]);
        return $resonse;
        
    }

}

?>