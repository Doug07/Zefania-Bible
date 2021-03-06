<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <  Generated with Cook           (100% Vitamin) |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		1.6
* @package		ZefaniaBible
* @subpackage	Users
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

defined('_JEXEC') or die;


/**
 * Build the route for the com_zefaniabible component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */
function ZefaniabibleBuildRoute(&$query){

	$segments = array();
	if(isset($query['view']))
	{
		$view = $query['view'];
		$segments[] = $view;
		unset( $query['view'] );
	}
	if(isset($query['cid']))
	{
		if(in_array($view, array()))
		{
			$segments[] = (is_array($query['cid'])?implode(',', $query['cid']):$query['cid']);
			unset( $query['cid'] );
		}
	};
	if(isset($query['a']))
	{
		$segments[] = $query['a'];
		unset( $query['a'] );				
	}	
	if(isset($query['b']))
	{
		$segments[] = $query['b'];
		unset( $query['b'] );				
	}
	if(isset($query['c']))
	{
		$segments[] = $query['c'];
		unset( $query['c'] );				
	}
	if(isset($query['d']))
	{
		$segments[] = $query['d'];
		unset( $query['d'] );				
	}
	if(isset($query['e']))
	{
		$segments[] = $query['e'];
		unset( $query['e'] );				
	}
	if(isset($query['f']))
	{
		$segments[] = $query['f'];
		unset( $query['f'] );				
	}
	if(isset($query['g']))
	{
		$segments[] = $query['g'];
		unset( $query['g'] );				
	}
	if(isset($query['h']))
	{
		$segments[] = $query['h'];
		unset( $query['h'] );				
	}			

	return $segments;
}


/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function ZefaniabibleParseRoute($segments)
{
	$vars = array();


	$vars['view'] = $segments[0];

	$nextPos = 1;
	if (isset($segments[$nextPos]))
	{	
		$vars['a'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{
		$vars['b'] = $segments[$nextPos];	
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{
		$vars['c'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{	
		$vars['d'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{	
		$vars['e'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{	
		$vars['f'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{	
		$vars['g'] = $segments[$nextPos];
		$nextPos++;
	}
	if (isset($segments[$nextPos]))
	{	
		$vars['h'] = $segments[$nextPos];
		$nextPos++;
	}		
	//Item layout : get the cid value
	if(in_array($vars['view'], array()) && isset($segments[$nextPos]))
	{
		$slug = $segments[$nextPos];
		$id = explode( ':', $slug );
		$vars['cid'] = (int) $id[0];

		$nextPos++;
	}

	return $vars;
}

