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

class RPMSignature extends RPMHeader {

	function RPMSignature($io)
	{
		if (PEAR::isError($ret = $this->RPMHeader($io))) {
			return $this->raiseError($ret);
		}
		// Read in all the tags
		reset($this->index->entries);
		while (list($offset,$entry) = each($this->index->entries)) {
			$me = $this->getTagDescription($entry->tag);
			$this->$me = $this->readEntry($offset,$entry->type,$entry->tag,$entry->count);
		}

		// Signature, unlike the header, has to be 8 byte aligned
		// seek to end of sig if not aligned
		$size = ftell($this->_io->fp) - $this->_start;
		if (($left = $size % 8) != 0) {
			$pos  = ftell($this->_io->fp);
			$seek = 8 - $left;
			$dest = $this->_size + $seek;
			fseek($this->_io->fp,$seek,SEEK_CUR);
		}
	}

    function getTagDescription($tag)
    {
		// overrides the header's tag desc
		// so we can set proper signature tags
		return rpm_signature_tag($tag);
    }

}

?>