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

class RPMIndexEntry extends PEAR {

	var $tag;
	var $type;
	var $offset;
	var $count;
	var $_size;

	function RPMIndexEntry($io)
	{
		$this->PEAR();
		if (PEAR::isError($this->tag    = $io->readInt())) return $this->raiseError($this->tag);
		if (PEAR::isError($this->type   = $io->readInt())) return $this->raiseError($this->type);
		if (PEAR::isError($this->offset = $io->readInt())) return $this->raiseError($this->offset);
		if (PEAR::isError($this->count  = $io->readInt())) return $this->raiseError($this->count);
		$this->_size = $io->getRead();
	}

	function _RPMIndexEntry()
	{
		$this->_PEAR();
	}

	function getSize()
	{
		return $this->_size;
	}

}

?>