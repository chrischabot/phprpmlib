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

class RPMHeader extends PEAR {

	var $index;
	var $_io;
	var $_start;

	function RPMHeader($io)
	{
		$this->PEAR();
		if (PEAR::isError($this->index = new RPMIndex($io))) {
			return $this->raiseError($this->index);
		}
		$this->_start = ftell($io->fp);
		$this->_io    = $io;
	}

	// See http://www.rpm.org/max-rpm/ch-queryformat-tags.html#S1-QUERYFORMAT-TAGS-QUERYFORMAT-TAGS
	// for a description of most tags
	function querytags()
	{
		$entry = false;
		reset($this->index->entries);
		while (list($offset,$indexEntry) = each($this->index->entries)) {
			$tags[] = $this->getTagDescription($indexEntry->tag);
		}
		return $tags;
	}


	// Query takes either a string ('SOURCERPM') or int define (RPMTAG_SOURCERPM)
	function query($tag)
	{
		$tags = array();
		reset($this->index->entries);
		while (list($offset,$indexEntry) = each($this->index->entries)) {
			if ($indexEntry->tag == $tag || $this->getTagDescription($indexEntry->tag) == $tag) {
				return $this->readEntry($offset,$indexEntry->type,$indexEntry->tag,$indexEntry->count);
			}
		}
		return false;
	}

	function readEntry($offset,$type,$tag,$count)
	{
		if (($seek = ($this->_start + $offset) - ftell($this->_io->fp)) != 0) {
			if (fseek($this->_io->fp,$seek,SEEK_CUR) == -1) {
				return $this->raiseError('Could not seek to index position in file');
			}
		}
		$dsize = 0;
		switch ($type) {
			case RPM_STRING:
			case RPM_I18NSTRING:
			case RPM_STRING_ARRAY:
				if ($count > 1) {
					$data = array();
					for ($i = 0 ; $i < $count ; $i++) {
						if (PEAR::isError($tmp = $this->_io->readStr())) {
							return $this->raiseError($tmp);
						}
						$data[] = $tmp;
					}
				} else {
					$data = $this->_io->readStr();
				}
				break;
			case RPM_NULL:
			case RPM_CHAR:
			case RPM_BIN:
				$data = $this->_io->readString($count);
				break;
			case RPM_INT8:
				$dsize = 1;
			case RPM_INT16:
				if (!$dsize) {
					$dsize = 2;
				}
			case RPM_INT32:
				if (!$dsize) {
					$dsize = 4;
				}
				if ($count > 1) {
					$data = array();
					for ($i = 0 ; $i < $count ; $i++) {
						if (PEAR::isError($tmp = $this->_io->read($dsize))) {
							return $this->raiseError($tmp);
						}
						$data[] = $this->_io->BigEndian2Int($tmp);
					}
				} else {
					if (PEAR::isError($tmp = $this->_io->read($dsize))) {
						return $this->raiseError($tmp);
					}
					$data = $this->_io->BigEndian2Int($tmp);
				}
				break;
			default:
				return $this->raiseError('RPMHeader: Unhandled data type '.$type);
				break;
		}
		if (PEAR::isError($data)) {
			return $this->raiseError($data);
		}
		if ($type == RPM_BIN) {
			// php isn't exactly binary safe, so store it
			// as hex code in a string (use hex2bin to convert back)
			$data = bin2hex($data);
		}
		return array(
				'tag'   => is_int($tag) ? $this->getTagDescription($tag) : $tag,
				'type'  => $this->getTypeDescription($type),
				'count' => $count,
				'value' => $data
				);
	}

	function printEntries()
	{
		reset($this->entries);
		echo "\nPrinting ".get_class($this)." values:\n";
		while (list(,$entry) = each($this->entries)) {
			if (is_array($entry['value'])) {
				reset($entry['value']);
				while (list(,$val) = each($entry['value'])) {
					printf("%-17s | %-12s | %s\n",$entry['tag_desc'],$entry['type_desc'],$val);
				}
			} else {
				printf("%-17s | %-12s | %s\n",$entry['tag_desc'],$entry['type_desc'],$entry['value']);
			}
		}
	}

	function getTypeDescription($type)
	{
		return rpm_index_type($type);
	}

	function getTagDescription($tag)
	{
		return rpm_header_tag($tag);
	}

	function _RPMHeader()
	{
		$this->_PEAR();
	}

	function getSize()
	{
		return $this->_size;
	}
}

?>