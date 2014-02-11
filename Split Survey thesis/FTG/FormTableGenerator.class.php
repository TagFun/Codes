<?php
/* LICENSED UNDER LGPL, DISREGARD REFERENCES TO OTHER LICENCES */
/**
 * ForumTableGenerator 
 * 
 * NOTES: 
 * Default variable values are shown in [] (square brackets) 
 * next to the variable's comment
 * 
 * Private functions/vars not fully (at all) commented '
 * 
 * ' As i am commenting @ 02:55 am (may update && || release extra info i people ask (via email)
 *
 * @author Michael J. Burgess
 * @email  ThinkChemical@GoogleMail.com [thinkchemical@googlemail.com]
 * @package FTG
 * @copyright Copyright 2006, Michael J. Burgess 
 * @version 1.0
 * @see Manual
 * @deprecated DO NOT USE THIS FOR ON-THE-FLY HTML TBL GENERATION, PERFORMANCE IS POOR! {file generation is intended}
 * @todo 'Optimise'
 */

/**
 * DESCRIBES INCLUDE [see file for extra info]
 * 
 * @package    XML_Unserializer
 * @author     Stephan Schmidt <schst@php.net>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: Unserializer.php,v 1.39 2005/09/28 11:19:56 schst Exp $
 * @link       http://pear.php.net/package/XML_Serializer
 * @see        XML_Serializer
 * 
 * IMPORTANT: This file has been sligtly modified to be compatible with the FTG xml namespace, 
 * the package described above will NOT work `as is` when downloaded from the PEAR site
 */
require('Unserializer.php');

/**
 * Opening syntax for PHP, this can be modified to allow the php 
 * to be proccessed as if it was inside a variable:
 * CHANGE TO: '. (if so desired)
 * 
 * to produce '.$php.' rather than <?=$php?> (change CLOSE too V )
 *
 */
define('FTG_PHP_OPEN', '<?=');

/**
 * Closing syntax for PHP, this can be modified to allow the php 
 * to be proccessed as if it was inside a variable:
 * CHANGE TO: .' (if so desired)
 * 
 * to produce '.$php.' rather than <?=$php?> (change OPEN too ^)
 *
 */
define('FTG_PHP_CLOSE', '?>');

/**
 * Set this to modify how output files are name, 
 * instead of '.php' they will end with FTG_PHP_EXT
 * If you are going to use the file as a 'content holder' you may
 * want to change this to something more descriptive, i.e.,
 * .table.php || .tbl.php || .content.php
 *
 */
define('FTG_PHP_EXT', '.php');

/**
 * Set this to modify how output files are name, 
 * instead of 'add_' or 'edit_' they will begin with FTG_FILE_OPEN
 *
 */
define('FTG_FILE_OPEN', false);

/**
 * Change this to the primary key of your table...
 * This is NOT essential, unless you want the ID field to show up
 * 
 * @see Construtor comments, Manual
 * 
 */
define('FTG_PRI_KEY', 'id');

/**
 * Used to generate tables wrapped in a form,
 * Fields are included along side descriptive lables
 * 
 * @see Manual
 * 
 */
class FormTableGenerator
{
	/**
	 * Allow primary key to be listed on html table
	 *
	 * @var bool
	 */
	var $allowID;
	
	 
	/*	PRIVATE VARIABLES */
	var $types;
	var $columnField;
	var $formField;
	var $masterHtml;
	/*	PRIVATE VARIABLES */
	
	/**
	 * DB Link
	 *
	 * @var resource
	 */
	var $link;
	
	/**
	 * Constructor, loads xml configuration file 
	 * If you want the `id` of a field to show up, set to true
	 * EXTRA: If you have not called your primary key `id` 
	 * you can change it by editing the FTG_PRI_KEY constant (above)
	 *
	 * @param unknown_type $link
	 * @return ForumTableGenerator
	 */
	function FormTableGenerator($link, $allowID = false)
	{
		$this->link = $link;
		$this->allowID = $allowID;
		if(!$this->_getFTGXML())
		{
			die('<br /><b>Warning: </b>Failed to Process XML File: <b>ftg.config.xml</b> is required!<br />');
		}
	}
	
	/**
	 * Generates table & saves it to a file 
	 * The file need not exist
	 *
	 * @param string $tbl
	 * DB Table name
	 * 
	 * @param string $pageType
	 * 'Add' or 'Edit' {capitals necessary]
	 * 
	 * @param string $action ['']
	 * Form's submission page
	 * 
	 * @param string $method ['POST']
	 * 'GET' or 'POST' 
	 * 
	 * @param string $file
	 * To be used if you would like a non-default file name
	 * 
	 * set FTG_FILE_OPEN to your opening filename value 
	 * then provide the main part of the filename via $file
	 * 
	 * WHEN FTG_FILE_OPEN is set file name ==  FTG_FILE_OPEN.$file.FTG_PHP_EXT
	 * 
	 * DEFAULT FILE NAME: 'add_'. || 'edit_'. $table . FTG_PHP_EXT 
	 * eg. add_comment.php, edit_image_table.php, add_TBL BLOG.php
	 * 
	 * @return string
	 * Success or error message
	 */
	function generatePage($tbl, $pageType, $action = '', $method = 'POST', $file = '')
	{
		$data = $this->generateTable($tbl, $pageType, $action, $method);
		return $this->saveToFile($file, $data, $pageType, $tbl);
	}
	
	/**
	 * MOVED TO PRIVATE
	 * 
	 * INFO: private functions are not discussed
	 * 
	 * @see THIS::generatePage()
	 */
	function saveToFile($file, $data, $page = '', $tbl = '')
	{
		$fileName =(FTG_FILE_OPEN == false) ? 
				strtolower("kysely").'_'.$tbl.FTG_PHP_EXT : FTG_FILE_OPEN.$file.FTG_PHP_EXT;
		
		$result = fwrite(fopen($fileName, 'w'), $data);
		
		if($result)
		{

		}
		//return ($result) ? $fileName.' was successfully written!' : $fileName.': failed writting!';
		return "";
	}
	
	/**
	 * Generate a html table
	 *
	 * @deprecated THIS::generatePage() preffered
	 * @deprecated DO NOT USE THIS FOR ON-THE-FLY TBL GENERATION, PERFORMANCE IS POOR!
	 * 
	 * @param string	 DB TBL 		 	$tbl
	 * @param string	 'Add' or 'Edit'	 $page {captials required!}
	 * @param string	 form Action 		 $action
	 * @param string	 form Method 		 $method
	 * @return string
	 */
	function generateTable($tbl, $page, $action = '', $method = 'POST')
	{
		$tableInfo = $this->getTableInfo($tbl);
		$tableName = ucwords($tbl);
		
		//---------------------------------------------------------------------------------
		// Tässä kirjoitetaan otsikko
		if($page == "Add")
		{
		$split = "<b>Kysely</b>";
		$kysely = "<b>Kirjoita kysymykset</b> <br> (kirjoita kysymys ilman kysymysmerkkiä)";
		}

		if($page == "Edit")
		{
		$split = "Split Survey";
		$kysely = "kysely";
		}

		$table = $this->_tablePart('tableOpen', $split.'_'.$kysely, $split.' - '.$kysely);
		
		
		//---------------------------------------------------------------------------------
		// Tässä kirjoitetaan kysymykset ja vastauskentät
		$num = count($tableInfo);		
		for($i = 0; $i < $num; $i++)
		{
			$label  = $this->_formField('label',$tableInfo[$i]->Field, $tableInfo[$i]->Label, $page);
			$field  = $this->_formField('textfield', $tableInfo[$i]->Field, $tableInfo[$i]->Textfield, $page);
			$table .= $this->_tablePart('tableSection', $label, $field);
		}
		
		//---------------------------------------------------------------------------------
		// Tässä kirjoitetaan painikkeet
		if($page == "Add")
		{
			$vastaa = "Luo";
			$kyselyyn = "Kysely";

		$table .= $this->_tablePart('tableClose', $vastaa.' '.$kyselyyn);
		}

		if($page == "Edit")
		{
			$vastaa = "vastaa";
			$kyselyyn = "kyselyyn";

		$table .= $this->_tablePart('tableClose', $vastaa.' '.$kyselyyn);
		}

		
		
		//---------------------------------------------------------------------------------
		//if($page == "Add")
		//return $this->_formPart('formOpen2', $tbl, $action, $method).$table.$this->_formPart('formClose2');
		
		//if($page == "Edit")
		return $this->_formPart('formOpen', $page.'_'.$tbl, $action, $method).$table.$this->_formPart('formClose');
		
		//return $tableInfo;
	}
	
	/**
	 * This has been provided as a public function purley for those who are curious
	 * Returns an array of objects describing a table
	 * var_dump'ing the return is recommended before use
	 *
	 * @param string $tbl 
	 * DB Table
	 * 
	 * @return array
	 */
	function getTableInfo($tbl)
	{
		$sql = "DESCRIBE `$tbl`";
		//echo $sql;
		$res = mysql_query($sql);
		
		$table = array();

		// debug
		//echo "Tässä ongelma alla--";


		while ($row = mysql_fetch_object($res)) 
		{	
			$this->_cleanUp($row);	
			if(!$this->allowID)
			{
				if($row->Field != FTG_PRI_KEY)
				{
					$table[] = $row;		
				}
			}
			
			else 
			{
				$table[] = $row;
			}
			
		}
		
		
		return $table;
	}
	
	
	/**
	 * PRIVATE FUNCTION
	 * 
	 * INFO:coverts xml to arrays, not discussed further
	 *
	 * @return bool
	 */
	function _getFTGXML()
	{
		$xml = new XML_Unserializer(array('complexType' => 'object'));
		
		if (!($xmlFile = @file_get_contents('FTG/ftg.config.xml')))
		{
			//echo "FOUND YA!! you got debugged";
			return false;
			exit();
		}
		
		if($xml->unserialize($xmlFile))
		{
			$config = $xml->getUnserializedData();
				
			$num = count($config->typePlugin);
			
			for ($i = 0; $i < $num; $i++)
			{
				$this->types[$config->typePlugin[$i]->type] = $config->typePlugin[$i]->asType;
				$this->columnField[$config->typePlugin[$i]->asType] = $config->typePlugin[$i]->asFormField;
			}

			$num = count($config->formPlugin);
			
			for ($i = 0; $i < $num; $i++)
			{
				$this->formField[$config->formPlugin[$i]->formFieldID] = $config->formPlugin[$i]->formFieldHTML;
			}
			
			$num = count($config->htmlMasterPlugin);
			
			for($i = 0; $i < $num; $i++)
			{
				$this->masterHtml[$config->htmlMasterPlugin[$i]->masterSection] = $config->htmlMasterPlugin[$i]->sectionHtml;	
			}
			
			return true;
		}
		
		else 
		{
			return false;
		}
	}
	
	/**
	 * PRIVATE FUNCTION
	 *
	 */
	function _formField($part, $name, $edit = '')
	{
		if($edit == 'Edit')
		{
			$edit = '';
		}
		elseif ($edit == 'Add')
		{
			$edit = '';
		}
		
		$html  = $this->formField[$part];
		$html  = str_replace('@name', $name, $html);
		$html  = str_replace('@edit', $edit, $html);
		$html  = str_replace('#phpopen#', FTG_PHP_OPEN, $html);
		$html  = str_replace('#phpclose#', FTG_PHP_CLOSE, $html);
		
		return $html;
	}
	
	/**
	 * PRIVATE FUNCTION
	 *
	 */
	function _formPart($part, $id = '', $action = '', $method = '')
	{
		$html = $this->masterHtml[$part];
		$html = str_replace('@id', $id, $html);
		$html = str_replace('@method', $method, $html);
		$html = str_replace('@action', $action, $html);
		return $html;
	}
	
	/**
	 * PRIVATE FUNCTION
	 *
	 */
	function _tablePart($part, $one = 'Submit', $two = 'Tyhjennä')
	{
		$html = $this->masterHtml[$part];
		$html = str_replace('@one', $one, $html);
		$html = str_replace('@two', $two, $html);
		return $html;
	}
	
	/**
	 * PRIVATE FUNCTION
	 *
	 */
	function _cleanUp(&$obj)
	{
		foreach ($this->types as $needle => $type)
		{
			 if(is_int(strpos($obj->Type, $needle)))
			 {
			 	$obj->Type = $type;
			 }
		}
		
		$obj->Label = ucwords(str_replace('_', ' ', $obj->Field));
		
		if (is_int(strpos($obj->Label, 'Id')))
		{
			$obj->Label = str_replace('Id', '', $obj->Label);
		}
	}
}

?>