<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <  Generated with Cook           (100% Vitamin) |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		1.6
* @package		ZefaniaBible
* @subpackage	Zefaniaverseofday
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

?>


<div class="grid_wrapper">
	<table id='grid' class='adminlist' cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th width="5%">
				<?php echo JText::_( 'NUM' ); ?>
			</th>

			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
            <th width="5%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<?php endif; ?>

			<th width="15%" style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "ZEFANIABIBLE_FIELD_BIBLE_SCRIPTURE", '_book_name_.bible_book_name', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>
			<th width="50%" style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "ZEFANIABIBLE_FIELD_VERSE", '', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<?php if ($this->access->get('core.edit.state') || $this->access->get('core.view.own')): ?>
			<th width="5%">
				<?php echo JHTML::_('grid.sort',  "ZEFANIABIBLE_FIELD_PUBLISH", 'a.publish', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->access->get('core.edit') || $this->access->get('core.edit.state')): ?>
			<th width="10%" class="order">
				<?php echo JHTML::_('grid.sort',  'Order', 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JDom::_('html.grid.header.saveorder', array('list' => $this->items));?>
			</th>
			<?php endif; ?>



		</tr>
	</thead>

	<tbody>
	<?php
	$k = 0;

	for ($i=0, $n=count( $this->items ); $i < $n; $i++):

		$row = &$this->items[$i];
		$str_verse = '';
		$z = 1;
		foreach($this->arr_verses[$i] as $obj_verse)
		{
			if($z > 1)
			{
				$str_verse = $str_verse.'<br>'.$obj_verse->verse;
			}
			else
			{
				$str_verse = $obj_verse->verse;
			}
			$z++;
		}

		?>

		<tr class="<?php echo "row$k"; ?>">

			<td class='row_id'>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
            </td>
			
			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
			<td>
				<?php echo JDom::_('html.grid.checkedout', array(
											'dataKey' => '',
											'dataObject' => $row,
											'num' => $i
												));
				?>

			</td>
			<?php endif; ?>

            <td style="text-align:center">
            	<?php
						$str_title = JText::_('ZEFANIABIBLE_BIBLE_BOOK_NAME_'.$row->book_name);
						$str_title = $str_title . " " .$row->chapter_number;
						if(($row->chapter_number)and($row->begin_verse)and(!$row->end_verse))
						{
							$str_title = $str_title .":". $row->begin_verse;
						}
						// Genesis 1:2-2:3
						else if(($row->chapter_number)and($row->begin_verse)and($row->end_verse))
						{
							$str_title = $str_title .":".$row->begin_verse.'-'.$row->end_verse;
						}
						echo $str_title;	

				?>
                 
			</td>
            <td style="text-align:left"><?php echo $str_verse;?></td>            
			<?php if ($this->access->get('core.edit.state') || $this->access->get('core.view.own')): ?>
            <td>
				<?php echo JDom::_('html.grid.publish', array(
										'dataKey' => 'publish',
										'dataObject' => $row,
										'num' => $i
											));
				?>
			</td>
			<?php endif; ?>
			<?php if ($this->access->get('core.edit') || $this->access->get('core.edit.state')): ?>
            <td class="order">
				<?php echo JDom::_('html.grid.ordering', array(
										'dataKey' => 'ordering',
										'dataObject' => $row,
										'num' => $i,
										'ordering' => $this->state->get('list.ordering'),
										'direction' => $this->state->get('list.direction'),
										'list' => $this->items,
										'ctrl' => 'zefaniaverseofday',
										'pagination' => $this->pagination
											));
				?>
			</td>
			<?php endif; ?>



		</tr>
		<?php
		$k = 1 - $k;

	endfor;
	?>
	</tbody>
	</table>




</div>

<?php echo JDom::_('html.pagination', null, $this->pagination);?>


