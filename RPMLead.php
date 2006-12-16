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

/*
 * RPM Lead Class
 * This class reads the RPM package lead (info is obsolete, rely on the RPMHeader info)
 *
 * The lead is the first part of an RPM package file. In previous versions
 * of RPM, it was used to store information used internally by RPM. Today,
 * however, the lead's sole purpose is to make it easy to identify an RPM
 * package file. For example, the file(1) command uses the lead. All the
 * information contained in the lead has been duplicated or superseded by
 * information contained in the header (RPMHeader class)
 * This class is used by the RPMFile class, and unless you know exactly what
 * your doing, you won't need to call this class your self.
 *
 * @see http://www.rpm.org/max-rpm/s1-rpm-file-format-rpm-file-format.html
 *
 * @access	private
 * @author	Chris Chabot <chabotc@4-ice.com>
 */

class RPMLead extends PEAR
{
	/**
	 * magic
	 * contains the magic header of a RPM package (has to be 'edabeedb')
	 * @var string
	 * @access public
	 */
	var $magic;

	/**
	 * major
	 * RPM file format major version. Versions of RPM later than 2.1 create version 3.0 package files.
	 * @var int
	 */
	var $major;

	/**
	 * minor
	 * RPM file format minor version. Versions of RPM later than 2.1 create version 3.0 package files. RPM file format minor version. Versions of RPM later than 2.1 create version 3.0 package files.
	 * @var int
	 * @access public
	 */
	var $minor;

	/**
	 * type
	 * Type of the RPM file. There are presently two types defined: 0 = binary, 1 = source.
	 * @var int
	 * @access public
	 */
	var $type;

	/**
	 * arch
	 * The architecture that the package was built for. If its a source package (type = 1) this should be ignored. Architecture-to-number translations can be found in the file /usr/lib/rpm/rpmrc.
	 * @var int
	 * @access public
	 */
	var $arch;

	/** name
	 * The name of the package
	 * @var string
	 * @access public
	 */
	var $name;

	/**
	 * osnum
	 * The operating system for which the package was built. Translations can be found in the file /usr/lib/rpm/rpmrc.
	 * @access public
	 * @var int
	 */
	var $osnum;

	/**
	 * signature_type
	 * A type 5 signature (version 3 RPM files and up) means it has a RPM Header instead of an actual signature.
	 * @access public
	 * @var int
	 */
	var $signature_type;

	/**
	 * reserved
	 * Not used, 16 bytes of padding
	 * @access public
	 * @var string
	 */
	var $reserved;

	/**
	 * _size
	 * size of lead record (96 bytes)
	 * @access public
	 * @var int
	 */
	var $_size;

	/**
	 * RPMLead constructor
	 * @param  io object RPMIO
	 * @access public
	 * @return object PEAR_Error Returns void or an error object
	 */
	function RPMLead($io)
	{
		$this->PEAR();
    	if (PEAR::isError($this->magic = $io->readHex(4)))              return $this->raiseError($this->magic);
		if ($this->magic != 'edabeedb')                                 return $this->raiseError('RPMLead: invalid magic number in '.$io->file);
		if (PEAR::isError($this->major          = $io->readByte()))     return $this->raiseError($this->major);
        if (PEAR::isError($this->minor          = $io->readByte()))     return $this->raiseError($this->minor);
        if (PEAR::isError($this->type           = $io->readWord()))     return $this->raiseError($this->type);
        if (PEAR::isError($this->arch           = $io->readWord()))     return $this->raiseError($this->arch);
        if (PEAR::isError($this->name           = $io->readString(66))) return $this->raiseError($this->name);
        if (PEAR::isError($this->osnum          = $io->readWord()))     return $this->raiseError($this->osnum);
        if (PEAR::isError($this->signature_type = $io->readWord()))     return $this->raiseError($this->signature_type);
        if (PEAR::isError($this->reserved       = $io->readString(16))) return $this->raiseError($this->reserved);
		$this->_size = $io->getRead();
	}

	/**
	 * RPMLead destructor
	 * @access private
	 */
	function _RPMLead()
	{
		$this->_PEAR();
	}

	/**
	 * getSize returns the (binary on disk) size of the lead record
	 * @access public
	 * @return int size of lead record
	 */
	function getSize()
	{
		return $this->_size;
	}

}

/*
 * Local Variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?>