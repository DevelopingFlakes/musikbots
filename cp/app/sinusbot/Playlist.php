<?php
/**
 * Class Playlist | src/Playlist.php
 *
 * A single Playlist with it's available actions
 *
 * @package      SinusBot
 * @author       Max Schmitt <max@schmitt.mx>
 */

namespace SinusBot;

/**
 * Class Playlist
 *
 * Playlist represents a single Playlist of the SinusBot
 */
class Playlist extends RestClient
{
/**
* UUID holds the Playlist UUID
* @var array
*/
    public $uuid = null;
/**
* Playlist stores the initial received playlist data
* @var array
*/
    private $playlist = null;
/**
* __construct
*
* @param  API     $api      SinusBot API
* @param  array   $playlist SinusBot Playlist array.
* @return void
*/
    public function __construct($api, $playlist)
    {
        parent::__construct($api);
        $this->uuid = $playlist['uuid'];
        $this->playlist = $playlist;
    }
  
    /**
    * rename renames a playlist
    *
    * @param string $playlistName new name for the playlist
    * @return array status
    */
    public function rename($playlistName)
    {
        return $this->request('/bot/playlists/'.$this->uuid, 'PATCH', [
        "name" => $playlistName,
        ]);
    }

    /**
    * getPlaylistTracks returns the tracks of the playlist
    *
    * @return array files
    */
    public function getTracks()
    {
        return $this->request('/bot/playlists/'.$this->uuid);
    }

    /**
    * getName returns the name of the playlist
    *
    * @return string name
    */
    public function getName()
    {
        return array_key_exists('name', $this->playlist)?$this->playlist['name']:'';
    }

    /**
    * getEntries returns the track entries
    *
    * @return array track entries
    */
    public function getEntries()
    {
        return array_key_exists('entries', $this->playlist)?$this->playlist['entries']:[];
    }
    
    /**
    * getSource returns the source of the playlist
    *
    * @return string source
    */
    public function getSource()
    {
        return array_key_exists('source', $this->playlist)?$this->playlist['source']:'';
    }
  
    /**
    * addPlaylistTrack adds a track to the playlist
    *
    * @param string $trackUUID uuid of the track
    * @return array status
    */
    public function addTrack($trackUUID)
    {
        return $this->request('/bot/playlists/'.$this->uuid, 'POST', [
        "uuid" => $trackUUID,
        ]);
    }
   
    /**
    * deleteTrack deletes a track from the playlist
    *
    * @param integer $trackPosition first entry = 0
    * @return array status
    */
    public function deleteTrack($trackPosition)
    {
        return $this->request('/bot/playlists/'.$this->uuid.'/'.$trackPosition, 'DELETE');
    }
   
    /**
    * deleteTracks deletes all the tracks in the playlist
    *
    * @return array status
    */
    public function deleteTracks()
    {
        $currentTracks = $this->getTracks();
        if ($currentTracks == null or !is_array($currentTracks)) {
            return null;
        }
    
        return $this->request('/bot/bulk/playlist/'.$this->uuid.'/files', 'POST', [
        "op" => "delete",
        "files" => array_keys($currentTracks['entries']),
        ]);
    }
    
    /**
    * delete deletes a playlist
    *
    * @return array status
    */
    public function delete()
    {
        return $this->request('/bot/playlists/'.$this->uuid, 'DELETE');
    }
}
