#!/usr/bin/php -Cq
<?php
/*
phpRPMLib 1.0
Copyright (C) 2005-2006, Chris Chabot

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once('PEAR.php');
require_once('RPMDefines.php');
require_once('RPMIO.php');
require_once('RPMLead.php');
require_once('RPMIndexEntry.php');
require_once('RPMIndex.php');
require_once('RPMHeader.php');
require_once('RPMSignature.php');

class RPMFile extends PEAR {
	var $file;
	var $lead;
	var $signature;
	var $header;

	function RPMFile($file)
	{
		$this->Pear();
		echo "[FILE]\n";
		if (PEAR::isError($this->file      =& new RPMIO($file)))              return $this->raiseError($this->file);
		echo "[LEAD]\n";
		if (PEAR::isError($this->lead      =& new RPMLead($this->file)))      return $this->raiseError($this->lead);
		echo "[SIGN]\n";
		if (PEAR::isError($this->signature =& new RPMSignature($this->file))) return $this->raiseError($this->signature);
		echo "[HEAD]\n";
		if (PEAR::isError($this->header    =& new RPMHeader($this->file)))    return $this->raiseError($this->header);

	}

	function _RPMFile()
	{
		$this->file->close();
		$this->_PEAR();
	}

	function getSize()
	{
		return $this->signature->SIZE();
	}

	function query($tag)
	{
		return $this->header->query($tag);
	}

	function querytags()
	{
		return $this->header->querytags();
	}
}


$rpm =& new RPMFile('/path/to/some/file.rpm');
$rpm->debug = true;
if (PEAR::isError($rpm)) {
	echo "\nError\n";
	var_dump($rpm);
}

echo "Parsed {$rpm->file->file}, rpm package v{$rpm->lead->major}.{$rpm->lead->minor}\n";
var_dump($rpm->signature);
$rpm->signature->printEntries();
$rpm->header->printEntries();
var_dump($rpm->querytags());
var_dump($rpm->query('REQUIRENAME'));

?>