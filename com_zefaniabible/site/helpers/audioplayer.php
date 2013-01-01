<?php 
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <  Generated with Cook           (100% Vitamin) |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		1.6
* @package		ZefaniaBible
* @subpackage	Zefaniabible
* @copyright	Missionary Church of Grace
* @author		Andrei Chernyshev - www.missionarychurchofgrace.org - andrei.chernyshev1@gmail.com
* @license		GNU/GPL
*
* /!\  Joomla! is free software.
* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*
*             .oooO  Oooo.     See COPYRIGHT.php for copyright notices and details.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/
defined('_JEXEC') or die('Restricted access');
class ZefaniaAudioPlayer 
{
	public function fnc_audio_player($str_Bible_Version,$int_Bible_Book_ID,$int_Bible_Chapter,$id)
	{
		$params = &JComponentHelper::getParams( 'com_zefaniabible' );
		$int_player_type = $params->get('player_type', '0');
		$int_player_width = $params->get('player_width', '250');
		$int_player_height = $params->get('player_height', '24');
		$str_xml_audio_path = $params->get('xmlAudioPath', 'media/com_zefaniabible/audio/');
		$str_xml_audio_full_path = $str_xml_audio_path . $this->fnc_get_audio_path($str_Bible_Version);
		$str_mp3_file_path = $this->fnc_parse_xml_file($str_xml_audio_full_path, $int_Bible_Book_ID,$int_Bible_Chapter,$str_xml_audio_path);
		$str_player = $this->fnc_get_audio_player($id,$int_player_type,$int_player_width,$int_player_height, $str_mp3_file_path,$int_Bible_Book_ID, $int_Bible_Chapter);
		return $str_player;
	}
	protected function fnc_parse_xml_file($str_xml_audio_full_path,$int_Bible_Book_ID,$int_Bible_Chapter,$str_xml_audio_path)
	{
		
		if(is_file($str_xml_audio_full_path))
		{
			$arr_audio_file = simplexml_load_file($str_xml_audio_full_path);
			$str_mp3_file_path = '';
			foreach($arr_audio_file->book as $arr_book)
			{
				if($arr_book['id'] == $int_Bible_Book_ID)
				{
					foreach( $arr_book as $arr_chapter)
					{
						if($arr_chapter['id'] == $int_Bible_Chapter)
						{
							$str_mp3_file_path =  $str_xml_audio_path.$arr_chapter;	
						}
					}
					break;
				}
			}
			if(!is_file($str_mp3_file_path))
			{
				$str_error = JText::_('ZEFANIABIBLE_FIELD_MP3_AUDIO_FILE_NOT_VALID')." ". JText::_('ZEFANIABIBLE_BIBLE_BOOK_NAME_'.$int_Bible_Book_ID)." ".$int_Bible_Chapter;
				JError::raiseWarning('',$str_error);
			}
		}
		else
		{
			JError::raiseWarning('',JText::_('ZEFANIABIBLE_FIELD_XML_AUDIO_FILE_LOCATION_NOT_VALID'));
		}
		return $str_mp3_file_path;
	}
	protected function fnc_get_audio_path($str_Bible_Version)
	{
		try 
		{
			$db		= JFactory::getDbo();
			$query =  'SELECT a.xml_audio_url FROM `#__zefaniabible_bible_names` AS a'.
			' WHERE a.alias="'.$str_Bible_Version.'"';
			
			$db->setQuery($query);
			$data = $db->loadResult();	
		}
		catch (JException $e)
		{
			$this->setError($e);
		}
		return $data;	
	}
	protected function fnc_get_audio_player($id,$int_player_type,$int_player_width,$int_player_height, $str_mp3_file_path, $int_Bible_Book_ID, $int_Bible_Chapter)
	{
		$doc_page =& JFactory::getDocument();
		$str_output = '';
		switch ($int_player_type)
		{
		case 0:
			{
				$doc_page->addScript('media/com_zefaniabible/player/jwplayer/jwplayer.js');
				$str_output = $str_output .  "<div id='mediaspace-".$id."'>".JText::_('ZEFANIABIBLE_BIBLE_ENABLE_FLASH')."</div>".PHP_EOL;
				$str_output = $str_output .  "<script type='text/javascript'>".PHP_EOL;
				$str_output = $str_output .  "jwplayer('mediaspace-".$id."').setup({".PHP_EOL;
				$str_output = $str_output .  "'flashplayer': '". JURI::root()."media/com_zefaniabible/player/jwplayer/player.swf',".PHP_EOL;
				$str_output = $str_output .  "'file': '".JURI::root().$str_mp3_file_path."',".PHP_EOL;
				$str_output = $str_output .  "'controlbar': 'bottom',".PHP_EOL;
				$str_output = $str_output .  "'width': '".$int_player_width."',".PHP_EOL;
				$str_output = $str_output .  "'height': '".$int_player_height."'".PHP_EOL;
				$str_output = $str_output .  "})".PHP_EOL;
				$str_output = $str_output .  "</script>".PHP_EOL;
			}
			break;
		case 1:
			{
				$doc_page->addScript('media/com_zefaniabible/player/audio_player/audio-player.js');
				$str_output = $str_output .  "<div id='mediaspace-".$id."'>".JText::_('ZEFANIABIBLE_BIBLE_ENABLE_FLASH')."</div>".PHP_EOL;
				$str_output = $str_output .'<script type="text/javascript">'.PHP_EOL;
				$str_output = $str_output .'	AudioPlayer.setup("'.JURI::root().'media/com_zefaniabible/player/audio_player/player.swf", {'.PHP_EOL;
				$str_output = $str_output .'	width: '.$int_player_width.','.PHP_EOL;
				$str_output = $str_output .'	transparentpagebg: "yes",'.PHP_EOL;
				$str_output = $str_output .'	});  '.PHP_EOL;
				$str_output = $str_output .'	AudioPlayer.embed("mediaspace-'. $id.'", {  '.PHP_EOL;
				$str_output = $str_output .'	soundFile: "'. JURI::root().$str_mp3_file_path.'",  '.PHP_EOL;
				$str_output = $str_output .'	titles: "'.JText::_('ZEFANIABIBLE_BIBLE_BOOK_NAME_'.$int_Bible_Book_ID)." ".$int_Bible_Chapter.'",'.PHP_EOL;  
				$str_output = $str_output .'	artists: "';
				$str_output = $str_output . JText::_('ZEFANIABIBLE_BIBLE_BOOK_NAME_'.$int_Bible_Book_ID)." ".$int_Bible_Chapter;
				$str_output = $str_output .'",'.PHP_EOL;
				$str_output = $str_output .'	autostart: "no"  '.PHP_EOL;
				$str_output = $str_output .'	});  '.PHP_EOL;
				$str_output = $str_output .'</script>'.PHP_EOL;
			}
			break;
		default:
			// flow player
			$doc_page->addScript('media/com_zefaniabible/player/flowplayer/flowplayer-3.2.6.min.js');
            $str_output = $str_output .'<a href="'. JURI::root().$str_mp3_file_path.'"'.PHP_EOL;
            $str_output = $str_output .'  style="display:block;width:'. $int_player_width.'px;height:'. $int_player_height.'px;"'.PHP_EOL;
            $str_output = $str_output .'  id="mediaspace-'.$id.'">'.PHP_EOL;
            $str_output = $str_output .'    </a>'.PHP_EOL;
			$str_output = $str_output .'	<script language="JavaScript">'.PHP_EOL;
            $str_output = $str_output .'    flowplayer("mediaspace-'.$id.'", "'.JURI::root().'media/com_zefaniabible/player/flowplayer/flowplayer-3.2.7.swf", {'.PHP_EOL;
			$str_output = $str_output .'		plugins:'.PHP_EOL;
			$str_output = $str_output .'		{'.PHP_EOL;
			$str_output = $str_output .'			controls: '.PHP_EOL;
			$str_output = $str_output .'			{'.PHP_EOL;
			$str_output = $str_output .'				fullscreen: false,'.PHP_EOL;
			$str_output = $str_output .'				widith: '. $int_player_width.','.PHP_EOL;
			$str_output = $str_output .'				height: '. $int_player_height.','.PHP_EOL;
			$str_output = $str_output .'				autoHide: false'.PHP_EOL;
			$str_output = $str_output .'			}'.PHP_EOL;
			$str_output = $str_output .'		},'.PHP_EOL;
			$str_output = $str_output .'		clip: '.PHP_EOL;
			$str_output = $str_output .'		{'.PHP_EOL;
			$str_output = $str_output .'			url: "'.JURI::root().$str_mp3_file_path.'",'.PHP_EOL;
			$str_output = $str_output .'			autoPlay: false,'.PHP_EOL;
			$str_output = $str_output .'		}'.PHP_EOL;
			$str_output = $str_output .'	});'.PHP_EOL;
			$str_output = $str_output .'	</script>'.PHP_EOL;                    
			break;
		}
		return $str_output;
	}
}
?>