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



$isNew		= ($this->zefaniabibleitem->id < 1);
$actionText = $isNew ? JText::_( "ZEFANIABIBLE_NEW" ) : JText::_( "ZEFANIABIBLE_EDIT" );
?>
<fieldset class="fieldsform">
	<legend><?php echo $actionText;?></legend>

	<table class="admintable">

		<tr>
			<td align="right" class="key">
				<label for="title">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_TITLE" ); ?> :
				</label>
			</td>
			<td>          
				<input id="bible_name" class="inputbox " type="text" size="32" value="<?php echo $this->zefaniabibleitem->bible_name; ?>" name="bible_name" onblur="validateFields('bible_name','<?php echo JText::_( "ZEFANIABIBLE_FIELD_TITLE" ); ?>')" />
			</td>
            <td>
            	<div id="bible_name_valid"></div>
            </td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="alias">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_ALIAS" ); ?> :
				</label>
			</td>
			<td> 
            	<input id="alias" class="inputbox " type="text" size="32" maxlength="5" value="<?php echo $this->zefaniabibleitem->alias; ?>" name="alias" onblur="validateFields('alias','<?php echo JText::_( "ZEFANIABIBLE_FIELD_ALIAS" ); ?>')"> 
			</td>
            <td>
            	<div id="alias_valid" ></div>
            </td>            
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="full_name">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_FULL_NAME" ); ?> :
				</label>
			</td>
			<td>
            	<input id="desc" name="desc" class="inputbox " value="<?php echo $this->zefaniabibleitem->desc; ?>" size="32" type="text" onblur="validateFields('desc','<?php echo JText::_( "ZEFANIABIBLE_FIELD_FULL_NAME" ); ?>')"> 
			</td>
            <td>
            	<div id="desc_valid" ></div>
            </td>                 
		</tr>
		<?php if ($this->access->get('core.edit.state')): ?>
		<tr>
			<td align="right" class="key">
				<label for="publish">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_PUBLISH" ); ?> :
				</label>
			</td>
			<td>
            	<input type="radio" name='publish' value="0" required="required" <?php if(!$this->zefaniabibleitem->publish){?>checked="checked" <?php } ?>/><?php echo JText::_( "JNO" ); ?>
            	<input type="radio" name='publish' value="1" required="required" <?php if($this->zefaniabibleitem->publish){?>checked="checked" <?php } ?>/><?php echo JText::_( "JYES" ); ?>
			</td>
		</tr>

		<?php endif; ?>
		<?php if ($this->access->get('core.edit') || $this->access->get('core.edit.state')): ?>
		<tr>
			<td align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_ORDERING" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.ordering', array(
												'dataKey' => 'ordering',
												'dataObject' => $this->zefaniabibleitem,
												'items' => $this->lists["ordering"],
												'labelKey' => 'bible_name',
												'aclAccess' => '',
												'validatorHandler' => "numeric"
												)); 						
				?>
			</td>
		</tr>

		<?php endif; ?>
		<tr>
			<td align="right" class="key">
				<label for="file_location">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_XML_BIBLE_FILE_LOCATION" ); ?> : 
				</label>
			</td>
			<td>
            	<div style="float:left">
					<?php if($isNew){ ?>
                    	<input name="xml_file_url" id="xml_file_url" value="<?php echo $this->zefaniabibleitem->xml_file_url; ?>" size="75" type="text">
                    <?php }else{?>
                    	<input name="xml_file_url" id="xml_file_url" value="<?php echo $this->zefaniabibleitem->xml_file_url; ?>" size="75"  disabled="disabled" type="text">
                     <?php }?>
                </div>                                
			</td>
        <?php if($isNew){ ?>
        <?php 
			$params	= JComponentHelper::getParams('com_zefaniabible');
		?>
        <tr>
        	<td>            	
            </td>
        	<td>
				<div id="infoUpload1" class="intend">
					<span id="btnUpload1"></span>
					<button id="btnCancel1" type="button" onclick="cancelQueue(upload1);" class="ss-hide upload_button" disabled="disabled">Cancel</button>
					<span id="biblepathinfo" class="pathinfo ss-hide hasTip" title="<?php echo JText::_('ZEFANIABIBLE_FIELD_XML_UPLOAD_UPLOADINFO_TOOLTIP'); ?>">
							<?php echo JText::_('ZEFANIABIBLE_FIELD_XML_UPLOAD_UPLOADINFO').' /'.trim($params->get('xmlBiblesPath', 'media/com_zefaniabible/bibles/'), '/').'/'; ?>
                    </span>
				</div>
            </td>
        </tr>
        <?php }?>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="xml_audio_file_location">
					<?php echo JText::_( "ZEFANIABIBLE_FIELD_XML_AUDIO_FILE_LOCATION" ); ?> :
				</label>
			</td>
			<td>
            	<input name="xml_audio_url" id="xml_audio_url" value="<?php echo $this->zefaniabibleitem->xml_audio_url; ?>" size="75" type="text">
			</td>
		</tr>
        <?php if($isNew){ ?>
		<tr>
        	<td></td>
        	<td>
				<div id="infoUpload2" class="intend">
					<span id="btnUpload2"></span>
					<button id="btnCancel2" type="button" onclick="cancelQueue(upload2);" class="ss-hide upload_button" disabled="disabled">Cancel</button>
					<span id="audiopathinfo" class="pathinfo ss-hide hasTip" title="<?php echo JText::_('ZEFANIABIBLE_FIELD_XML_UPLOAD_UPLOADINFO_TOOLTIP'); ?>">
	                    <?php echo JText::_('ZEFANIABIBLE_FIELD_XML_UPLOAD_UPLOADINFO').' /'.trim($params->get('xmlAudioPath', 'media/com_zefaniabible/audio/'), '/').'/'; ?>
                    </span>
				</div>
            </td>
        </tr>
        <?php }?>

	</table>
</fieldset>
