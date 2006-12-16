<?
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

class RPMIO extends PEAR {

	var $fp;
	var $file;
	var $_cnt;

	function RPMIO($file)
	{
		$this->file = $file;
		if (!file_exists($file))            return $this->raiseError("RPMIO: No such file ".$file);
		if (!$this->fp = fopen($file,'rb')) return $this->raiseError("RPMIO: Could not open ".$file." for reading");
	}

	function _RPMIO()
	{
		$this->_PEAR();
	}

	// Gets the amount of bytes read and resets counter
	// used to determine index, header and signature sizes
	function getRead()
	{
		$ret = $this->_cnt;
		$this->_cnt = 0;
		return $ret;
	}

	function close()
	{
		fclose($this->fp);
		$this->fp = false;
	}

	function read($bytes)
	{
		if (strlen($read = fread($this->fp,$bytes)) == 0) {
			return $this->raiseError("RPMIO: Error reading $bytes bytes from {$this->file}");
		}
		$this->_cnt += $bytes;
		return $read;
	}

	function readByte()
	{
		return PEAR::isError($ret = $this->read(1)) ? $ret : ord($ret);
	}

	function readWord()
	{
		return PEAR::isError($ret = $this->read(2)) ? $ret : $this->BigEndian2Int($ret);
	}

	function readInt($signed=false)
	{
		return PEAR::isError($ret = $this->read(4)) ? $ret : $this->BigEndian2Int($ret);
	}

	function readString($len)
	{
		return PEAR::isError($ret = $this->read($len)) ? $ret : trim($ret);
	}

	function readStr()
	{
		$ret = '';
		while (!PEAR::isError($chr = $this->read(1))) {
			if (ord($chr) == 0) {
				break;
			}
			$ret .= $chr;
		}
		return PEAR::isError($chr) ? $chr : $ret;
	}

	function readHex($len)
	{
		if (PEAR::isError($buf = $this->read($len))) return $this->raiseError($buf);
		$ret = '';
		for ($i = 0 ; $i < $len ; $i++) {
			$ret .= dechex(ord($buf{$i}));
		}
		return $ret;
	}

	function trunc($floatnumber)
	{
		// truncates a floating-point number at the decimal point
		// returns int (if possible, otherwise float)
		if ($floatnumber >= 1) {
			$truncatednumber = floor($floatnumber);
		} elseif ($floatnumber <= -1) {
			$truncatednumber = ceil($floatnumber);
		} else {
			$truncatednumber = 0;
		}
		if ($truncatednumber <= pow(2, 30)) {
			$truncatednumber = (int) $truncatednumber;
		}
		return $truncatednumber;
	}

	function castInt($floatnum)
	{
		// convert to float if not already
		$floatnum = (float) $floatnum;
		// convert a float to type int, only if possible
		if ($this->trunc($floatnum) == $floatnum) {
			// it's not floating point
			if ($floatnum <= pow(2, 30)) {
				// it's within int range
				$floatnum = (int) $floatnum;
			}
		}
		return $floatnum;
	}

	function BigEndian2Int($byteword, $signed=false)
	{
		$intvalue = 0;
		$bytewordlen = strlen($byteword);
		for ($i = 0; $i < $bytewordlen; $i++) {
			$intvalue += ord($byteword{$i}) * pow(256, ($bytewordlen - 1 - $i));
		}
		if ($signed) {
			switch ($bytewordlen) {
				case 1:
				case 2:
				case 3:
				case 4:
					$signmaskbit = 0x80 << (8 * ($bytewordlen - 1));
					if ($intvalue & $signmaskbit) {
						$intvalue = 0 - ($intvalue & ($signmaskbit - 1));
					}
					break;
				default:
					return $this->raiseError('RPMIO: Cannot have signed integers larger than 32-bits in BigEndian2Int');
					break;
			}
		}
		return $this->castInt($intvalue);
	}
}

?>