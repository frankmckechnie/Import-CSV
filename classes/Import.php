<?php 

class Import {

	private $fileName, 
			$_db,
			$log,
			$rows = array(),
			$headerRow = array(),
			$tableName;

	// instantiates the main classes
	public function __construct($name){
		$this->_db = DB::getInstance();
		$this->log = new Log();

		if(!empty($name)){
			$this->fileName = $name;
			$this->tableName = substr($this->fileName, 0,-4);
			if(!$this->read()){
				$this->log->write('attempt to read file failed', '-import-');
				fwrite(STDOUT, "attempt to read file failed \n");
				die();
			}
			$this->import();
		}else{
			$this->log->write("no name given", '-import-');
			fwrite(STDOUT, "no name given, try php run.php products.csv \n");
		}
		
	}

	public function get_rows(&$rows){
		$rows = $this->rows;
	}

	// reads the data from the file and validates
	public function read(){
	    $rowcount = 0;
	    if (($handle = fopen($this->fileName, "r")) !== FALSE) {
	        $max_line_length = defined('MAX_LINE_LENGTH') ? MAX_LINE_LENGTH : 10000;
	        $this->headerRow = fgetcsv($handle, $max_line_length);
	        // DB::getInstance()->createTable($this->tableName, $this->headerRow); // make a database table from the data
	        $header_colcount = count($this->headerRow);
	        while (($row = fgetcsv($handle, $max_line_length)) !== FALSE) {
	            $row_colcount = count($row);
	            if ($row_colcount == $header_colcount) {
	                $entry = array_combine($this->headerRow, $row);
	                $this->rows[] = $entry;
	            }
	            else {
	            	fwrite(STDOUT, "csvreader: Invalid number of columns at line \n");
	                $this->log->write("csvreader: Invalid number of columns at line " . ($rowcount + 2) . " (row " . ($rowcount + 1) . "). Expected=$header_colcount Got=$row_colcount", '-csvError-');
	                return false;
	            }
	            $rowcount++;
	        }
	        fclose($handle);
	    }
	    else {
	    	fwrite(STDOUT, "csvreader: Could not read CSV ".$this->filename." \n");
       		$this->log->write("csvreader: Could not read CSV \"$this->filename\"", '-csvError-');
	        return false;
	    }
	    return true;
	}

	function create($table, $fields = array()) {
	    if(!$this->_db->insert($table, $fields)) {
	        throw new Exception('Sorry, there was a problem creating your ' . $table);
	    }
	}

	public function update($table,$operator,$id,$fields){
        if(!$this->_db->update($table,$operator,$id,$fields)){
            throw new Exception('Error:There was a problem updating.');   
        }
    }


	// trys to inser if not it will try to update
	public function import(){

		foreach ($this->rows as $row) {

			// for($i = 0; $i < count($row); ++$i){
			// 	$result = $this->_db->get($this->tableName, array($this->headerRow[$i],'=', $row[$this->headerRow[$i]]));
			// 	if($result->count() > 0){
			// 		echo "kool";
			// 	}
			// } this can check every field but it takes too long 

			$result = $this->_db->get($this->tableName, array($this->headerRow[0],'=', $row[$this->headerRow[0]]));
			if($result->count() > 0){
			    try{
			    	$data = $this->update($this->tableName, $this->headerRow[0], $row[$this->headerRow[0]], $row); // update works but puts it to the bottom of table
			    } catch(Exception $e){
			        die("ERROR:".$e->getMessage()); 
			    }
			    fwrite(STDOUT, "row ".$row[$this->headerRow[0]]." has been updated\n");
			}else{
			    try{
			      $this->create($this->tableName, $row);  
			    } catch(PDOException $e){
			        die("ERROR:".$e->getMessage());
			    }
			    fwrite(STDOUT, "row ".$row[$this->headerRow[0]]." has been inserted\n");


			}
		
		}

	}
}
