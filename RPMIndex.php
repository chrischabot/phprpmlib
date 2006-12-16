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

class RPMIndex extends PEAR {

	var $magic;
	var $version;
	var $reserved;
	var $num_index;
	var $num_data;
	var $entries = array();
	var $_size;

	function RPMIndex($io)
	{
		$this->PEAR();
		if (PEAR::isError($this->magic     = $io->readHex(3)))    return $this->raiseError($this->magic);
		if ($this->magic != '8eade8')                             return $this->raiseError('RPMIndex: invalid magic header in '.$io->file);
		if (PEAR::isError($this->version   = $io->readByte()))    return $this->raiseError($this->version);
		if (PEAR::isError($this->reserved  = $io->readString(4))) return $this->raiseError($this->reserved);
		if (PEAR::isError($this->num_index = $io->readInt()))     return $this->raiseError($this->num_index);
		if (PEAR::isError($this->num_data  = $io->readInt()))     return $this->raiseError($this->num_data);
		$this->_size = $io->getRead();
		for ($i = 0 ; $i < $this->num_index ; $i++) {
			if (PEAR::isError($entry = new RPMIndexEntry($io))) return $this->raiseError($entry);
			$this->_size                  += $entry->getSize();
			$this->entries[$entry->offset] = $entry;
		}
		// Sort by offset so they can be read linearly from the file
		ksort($this->entries);
	}

	function _RPMIndex()
	{
		$this->_PEAR();
	}

	function getSize()
	{
		return $this->_size;
	}

}

?>