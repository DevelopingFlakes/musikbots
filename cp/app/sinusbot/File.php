<?php
/**
 * Class File | src/File.php
 *
 * A single File with it's available actions
 *
 * @package      SinusBot
 * @author       Max Schmitt <max@schmitt.mx>
 */

namespace SinusBot;

/**
 * Class File
 *
 * File represents a single File of the SinusBot
 */
class File extends RestClient
{
    /**
    * UUID holds the File UUID
    * @var array
    */
    public $uuid = null;
    /**
    * File stores the initial received file data
    * @var array
    */
    private $file = null;
    /**
    * __construct
    *
    * @param API      $api    SinusBot API
    * @param array    $file   SiusBot File array
    */
    public function __construct($api, $file)
    {
        parent::__construct($api);
        $this->uuid = $file['uuid'];
        $this->file = $file;
    }

    /**
    * getTitle returns the title
    *
    * @return string filename
    * @api
    */
    public function getTitle()
    {
        return array_key_exists('title', $this->file)?$this->file['title']:$this->file["filename"];
    }
    
    /**
    * getUUID returns the uuid
    *
    * @return string file UUID
    * @api
    */
    public function getUUID()
    {
        return $this->uuid;
    }

    /**
    * getType returns the file type
    *
    * @return string type: url, folder
    * @api
    */
    public function getType()
    {
        return array_key_exists('type', $this->file)?$this->file['type']:'';
    }

    /**
    * getArtist returns the artist
    *
    * @return string file UUID
    * @api
    */
    public function getArtist()
    {
        return array_key_exists('artist', $this->file)?$this->file['artist']:'';
    }

    /**
    * getUUID returns the uuid
    *
    * @return string file UUID
    * @api
    */
    public function getParent()
    {
        return $this->file["parent"];
    }

    /**
    * delete
    *
    * @return array status
    * @api
    */
    public function delete()
    {
        return $this->request('/bot/files/'.$this->uuid, 'DELETE');
    }

    /**
    * getThumbnail
    *
    * @return string  url
    */
    public function getThumbnail()
    {
        return array_key_exists('thumbnail', $this->file)?$this->url.'/cache/'.$this->file["thumbnail"]:null;
    }


    /**
    * edit
    *
    * @param Array $options - keys: displayTitle, title, artist, album...
    * @return array status
    * @api
    */
    public function edit($options)
    {
        return $this->request('/bot/files/'.$this->uuid, 'PATCH', $options);
    }

    /**
    * move
    *
    * @param string $parent subfolder UUID, empty value means root folder
    * @return array status
    */
    public function move($parent = "")
    {
        return $this->request('/bot/files/'.$this->uuid, 'PATCH', [
        "parent" => $parent,
        ]);
    }
}
