<?php
/**
 * Class Instance | src/Instance.php
 *
 * A single Instance with it's available actions
 *
 * @package      SinusBot
 * @author       Max Schmitt <max@schmitt.mx>
 */

namespace SinusBot;

/**
 * Class Instance
 *
 * Instance represents a single instance of the SinusBot
 */
class Instance extends RestClient
{
    /**
    * UUID stores the SinusBot Instance UUID
    * @var string
    */
    public $uuid = null;
    /**
    * Instance stores the initial received instance data
    * @var array
    */
    private $instance = null;
    /**
    * __construct
    *
    * @param  API     $api      SinusBot API
    * @param  array   $instance SinusBot Instance array
    * @return void
    */
    public function __construct($api, $instance)
    {
        parent::__construct($api);
        $this->uuid = $instance['uuid'];
        $this->instance = $instance;
    }
    /**
    * isPlaying returns true when the instance is playing something
    *
    * @return boolean
    */
    public function isPlaying()
    {
        return $this->instance['playing'];
    }
  
    /**
    * isRunning returns true when the instance is running
    *
    * @return boolean
    */
    public function isRunning()
    {
        return $this->instance['running'];
    }

    /**
    * getBackend returns the SinusBot backend (Discord, TS³)
    *
    * @return string instance backend
    */
    public function getBackend()
    {
        return $this->instance['backend'];
    }

    /**
    * getNick returns the Bot's nickname
    *
    * @return string nick
    */
    public function getNick()
    {
        return $this->instance['nick'];
    }

    /**
    * getName returns the Bot's name
    *
    * @return string name
    */
    public function getName()
    {
        return $this->instance['name'];
    }

    /**
    * getServerHost returns the Bot's server host
    *
    * @return string host
    */
    public function getServerHost()
    {
        return $this->instance['serverHost'];
    }

    /**
    * getServerPort returns the Bot's server port
    *
    * @return string port
    */
    public function getServerPort()
    {
        return $this->instance['serverPort'];
    }

    /**
    * delete deletes the instance
    *
    * @return array status
    */
    public function delete()
    {
        return $this->request('/bot/instances/'.$this->uuid, 'DELETE');
    }
  
    /**
    * spawn spawns the instance
    *
    * @return array status
    */
    public function spawn()
    {
        return $this->request('/bot/i/'.$this->uuid.'/spawn', 'POST', '');
    }
  
    /**
    * respawn restarts the instance
    *
    * @return array status
    */
    public function respawn()
    {
        return $this->request('/bot/i/'.$this->uuid.'/respawn', 'POST', '');
    }
  
    /**
    * kill kills the instance
    *
    * @param  string  $instanceUUID  UUID of the SinusBot instance
    * @return array status
    */
    public function kill()
    {
        return $this->request('/bot/i/'.$this->uuid.'/kill', 'POST', '');
    }
  
    /**
    * getWebStream returns the webstream URL of the instance
    *
    * requires: EnableWebStream = true
    *
    * @param  string  $instanceUUID  UUID of the SinusBot instance
    * @return string  url (opus-encoded-ogg-stream)
    * @api
    */
    public function getWebStream()
    {
        $token = $this->getWebStreamToken();
        if ($token == null) {
            return null;
        }
    
        return $this->url.'/api/v1/b/bot/i/'.$this->uuid.'/stream/'.$token;
    }
  
    /**
    * getWebStreamToken returns the webstream token
    *
    * requires: EnableWebStream = true
    *
    * @param  string  $instanceUUID  UUID of the SinusBot instance
    * @return string  token
    * @api
    */
    public function getWebStreamToken()
    {
        $tokenRequest = $this->request('/bot/i/'.$this->uuid.'/streamToken', 'POST', '');
        return (isset($tokenRequest['token'])) ? $tokenRequest['token'] : null;
    }
    
    /**
    * getVolume returns the current volume
    *
    * @return integer
    * @api
    */
    public function getVolume()
    {
        return $this->getStatus()['volume'];
    }
  
    /**
    * setVolume sets the volume to a given one
    *
    * @param  string  $volume  {0-100}
    * @return array   status
    * @api
    */
    public function setVolume($volume)
    {
        return $this->request('/bot/i/'.$this->uuid.'/volume/set/'.$volume, 'POST', '');
    }
  
    /**
    * setVolumeUp increases the volume by 5
    *
    * @return array status
    * @api
    */
    public function setVolumeUp()
    {
        return $this->request('/bot/i/'.$this->uuid.'/volume/up', 'POST', '');
    }
  
    /**
    * setVolumeDown reduces the volume by 5
    *
    * @return array status
    * @api
    */
    public function setVolumeDown()
    {
        return $this->request('/bot/i/'.$this->uuid.'/volume/down', 'POST', '');
    }

    /**
    * getStatus returns the current instance status
    *
    * @return array status
    * @api
    */
    public function getStatus()
    {
        return $this->request('/bot/i/'.$this->uuid.'/status');
    }

    /**
    * getLog returns the instance log
    *
    * @return array log
    * @api
    */
    public function getLog()
    {
        return $this->request('/bot/i/'.$this->uuid.'/log');
    }

    /**
    * getSettings returns the instance settings
    *
    * @return array users
    * @api
    */
    public function getSettings()
    {
        return $this->request('/bot/i/'.$this->uuid.'/settings');
    }
  
    /**
    * setSettings updates the instance settings
    *
    * @param array $data array of properties
    * @return array status
    * @api
    */
    public function setSettings($data)
    {
        return $this->request('/bot/i/'.$this->uuid.'/settings', 'POST', $data);
    }
  
    /**
    * getChannels returns the channels of the connected TS³ or Discord server
    *
    * @return array channels
    * @api
    */
    public function getChannels()
    {
        return $this->request('/bot/i/'.$this->uuid.'/channels');
    }
  
    /**
    * uploadAvatar uploads a avatar from a local file
    *
    * @param string $path /var/www/image.jpg
    * @return array status
    */
    public function uploadAvatar($path)
    {
        return $this->request('/bot/i/'.$this->uuid.'/avatar', 'POST', file_get_contents($path), true);
    }
  
    /**
    * deleteAvatar deletes the current avatar
    *
    * @return array status
    */
    public function deleteAvatar()
    {
        return $this->request('/bot/i/'.$this->uuid.'/avatar', 'DELETE');
    }

    /**
    * getQueueTracks returns the tracks in the queue
    *
    * @return array files
    */
    public function getQueueTracks()
    {
        return $this->request('/bot/i/'.$this->uuid.'/queue');
    }

    /**
    * appendQueueTrack adds a track to the queue
    *
    * @param string $trackUUID uuid of the track
    * @return array status
    */
    public function appendQueueTrack($trackUUID)
    {
        return $this->request('/bot/i/'.$this->uuid.'/queue/append/'.$trackUUID, 'POST', "");
    }
  
    /**
    * prependQueueTrack adds a track to the beginning of the queue
    *
    * @param string $trackUUID track uuid
    * @return array status
    */
    public function prependQueueTrack($trackUUID)
    {
        return $this->request('/bot/i/'.$this->uuid.'/queue/prepend/'.$trackUUID, 'POST', "");
    }
  
    /**
    * deleteQueueTrack deletes a track in the queue
    *
    * @param integer $trackPosition  first entry = 0
    * @return array status
    */
    public function deleteQueueTrack($trackPosition)
    {
        $currentTracks = $this->getQueueTracks();
        if ($currentTracks == null or !is_array($currentTracks)) {
            return null;
        }
        unset($currentTracks[$trackPosition]);
    
        return $this->request('/bot/i/'.$this->uuid.'/queue', 'PATCH', array_values($currentTracks));
    }
  
    /**
    * deleteQueueTracks deletes all the tracks in the queue
    *
    * @return array status
    */
    public function deleteQueueTracks()
    {
        return $this->request('/bot/i/'.$this->uuid.'/queue', 'PATCH', []);
    }
  
    /**
    * say will say the given text via the tts
    *
    * @param  string  $text          Welcome
    * @param  string  $locale        en
    * @return array status
    */
    public function say($text, $locale)
    {
        return $this->request('/bot/i/'.$this->uuid.'/say', 'POST', [
        "text" => $text,
        "locale" => $locale,
        ]);
    }
  
    /**
    * playTrack will play the given track
    *
    * @param  string  $trackUUID   UUID of the track
    * @return array   status
    */
    public function playTrack($trackUUID)
    {
        return $this->request('/bot/i/'.$this->uuid.'/play/byId/'.$trackUUID, 'POST', '');
    }
  
    /**
    * playURL will play the given URL
    *
    * @param string $url stream url
    * @return array status
    */
    public function playURL($url)
    {
        return $this->request('/bot/i/'.$this->uuid.'/playUrl?url='.urlencode($url), 'POST', '');
    }
  
    /**
    * playPlaylist will play the given playlist
    *
    * @param string $playlistUUID uuid of a playlist
    * @param string $playlistIndex 0
    * @return array status
    */
    public function playPlaylist($playlistUUID, $playlistIndex = 0)
    {
        return $this->request('/bot/i/'.$this->uuid.'/play/byList/'.$playlistUUID.'/'.$playlistIndex, 'POST', '');
    }
  
    /**
    * playPrevious will play the previous track
    *
    * @return array status
    */
    public function playPrevious()
    {
        return $this->request('/bot/i/'.$this->uuid.'/playPrevious', 'POST', '');
    }
  
    /**
    * playNext will play the next track
    *
    * @return array status
    */
    public function playNext()
    {
        return $this->request('/bot/i/'.$this->uuid.'/playNext', 'POST', '');
    }
  
    /**
    * playRepeat enables the play repeat
    *
    * @param  integer $repeatState   {0=disable,1=enable}
    * @return array status
    */
    public function playRepeat($repeatState = 1)
    {
        return $this->request('/bot/i/'.$this->uuid.'/repeat/'.$repeatState, 'POST', '');
    }
  
    /**
    * playShuffle enables the shuffly functionality
    *
    * @param  integer $shuffleState  {0=disable,1=enable}
    * @return array status
    */
    public function playShuffle($shuffleState = 1)
    {
        return $this->request('/bot/i/'.$this->uuid.'/shuffle/'.$shuffleState, 'POST', '');
    }
  
    /**
    * stop stops the playback
    *
    * @return array status
    */
    public function stop()
    {
        return $this->request('/bot/i/'.$this->uuid.'/stop', 'POST', '');
    }
  
    /**
    * seekPlayback seeks to a given position
    *
    * @param  integer  $position      0
    * @return array status
    */
    public function seekPlayback($position = 0)
    {
        return $this->request('/bot/i/'.$this->uuid.'/seek/'.$position, 'POST', '');
    }
  
    /**
    * getPlayedTracks will return the played tracks
    *
    * @return array   array of uuids
    */
    public function getPlayedTracks()
    {
        return $this->request('/bot/i/'.$this->uuid.'/recent', 'POST', '');
    }

    /**
    * getCurrentTrack returns the current track which will be played
    *
    * @return File
    */
    public function getCurrentTrack()
    {
        return new File($this, $this->getStatus()['currentTrack']);
    }
}
