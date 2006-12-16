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
*//*
  See /usr/include/rpm/rpmlib.h for the C definitions of these vales
  and some basic descriptions. Refer to the maxrpm book for better
  references.
*/

// Index type definitions
define('RPM_NULL', 0);
define('RPM_CHAR', 1);
define('RPM_INT8', 2);
define('RPM_INT16', 3);
define('RPM_INT32', 4);
define('RPM_INT64', 5); // Should not happen', rpmlib lists this as 'currently unsupported'
define('RPM_STRING', 6);
define('RPM_BIN', 7);
define('RPM_STRING_ARRAY', 8);
define('RPM_I18NSTRING', 9);

// translate the index type to string representation
function rpm_index_type($type)
{
	switch ($type) {
		case RPM_NULL:         return 'NULL';
		case RPM_CHAR:         return 'CHAR';
		case RPM_INT8:         return 'INT8';
		case RPM_INT16:        return 'INT16';
		case RPM_INT32:        return 'INT32';
		case RPM_INT64:        return 'INT64';
		case RPM_STRING:       return 'STRING';
		case RPM_BIN:          return 'BIN';
		case RPM_STRING_ARRAY: return 'STRING_ARRAY';
		case RPM_I18NSTRING:   return 'I18NSTRING';
		default:               return "RPM_UNKNOWN ($type)";
	}
}

// Signature tag types
define('SIGTAG_HEADERSIGNATURES', 62);
define('SIGTAG_BADSHA1_1', 264);
define('SIGTAG_BADSHA1_2', 265);
define('SIGTAG_DSA', 267);
define('SIGTAG_RSA', 268);
define('SIGTAG_SHA1', 269);
define('SIGTAG_SIZE', 1000);
define('SIGTAG_LEMD5_1', 1001);
define('SIGTAG_PGP', 1002);
define('SIGTAG_LEMD5_2', 1003);
define('SIGTAG_MD5', 1004);
define('SIGTAG_GPG', 1005);
define('SIGTAG_PGP5', 1006);
define('SIGTAG_PAYLOADSIZE', 1007);

// translate signature tag to string representation
function rpm_signature_tag($tag)
{
	switch ($tag) {
		case SIGTAG_HEADERSIGNATURES: return 'HEADERSIGNATURES';
		case SIGTAG_BADSHA1_1: return 'BADSHA1_1';
		case SIGTAG_BADSHA1_2: return 'BADSHA1_2';
		case SIGTAG_DSA: return 'DSA';
		case SIGTAG_RSA: return 'RSA';
		case SIGTAG_SHA1: return 'SHA1';
		case SIGTAG_SIZE: return 'SIZE';
		case SIGTAG_LEMD5_1: return 'LEMD5_1';
		case SIGTAG_PGP: return 'PGP';
		case SIGTAG_LEMD5_2: return 'LEMD5_D';
		case SIGTAG_MD5: return 'MD5';
		case SIGTAG_GPG: return 'GPG';
		case SIGTAG_PGP5: return 'PGP5';
		case SIGTAG_PAYLOADSIZE: return 'PAYLOADSIZE';
		default: return 'UNKNOWN';
	}
}

// RPM header tag defines
define('RPMTAG_HEADERIMAGE', 61);
define('RPMTAG_HEADERSIGNATURES', 62);
define('RPMTAG_HEADERIMMUTABLE', 63);
define('RPMTAG_HEADERREGIONS', 64);
define('RPMTAG_HEADERI18NTABLE', 100);
define('RPMTAG_SIG_BASE', 256);
define('RPMTAG_SIGSIZE', 257);
define('RPMTAG_SIGLEMD5_1', 258);
define('RPMTAG_SIGPGP', 259);
define('RPMTAG_SIGLEMD5_2', 260);
define('RPMTAG_SIGMD5', 261);
define('RPMTAG_SIGGPG', 262);
define('RPMTAG_SIGPGP5', 263);
define('RPMTAG_BADSHA1_1', 264);
define('RPMTAG_BADSHA1_2', 265);
define('RPMTAG_PUBKEYS', 266);
define('RPMTAG_DSAHEADER', 267);
define('RPMTAG_RSAHEADER', 268);
define('RPMTAG_SHA1HEADER', 269);
define('RPMTAG_NAME', 1000);
define('RPMTAG_VERSION', 1001);
define('RPMTAG_RELEASE', 1002);
define('RPMTAG_SERIAL', 1003);
define('RPMTAG_SUMMARY', 1004);
define('RPMTAG_DESCRIPTION', 1005);
define('RPMTAG_BUILDTIME', 1006);
define('RPMTAG_BUILDHOST', 1007);
define('RPMTAG_INSTALLTIME', 1008);
define('RPMTAG_SIZE', 1009);
define('RPMTAG_DISTRIBUTION', 1010);
define('RPMTAG_VENDOR', 1011);
define('RPMTAG_GIF', 1012);
define('RPMTAG_XPM', 1013);
define('RPMTAG_COPYRIGHT', 1014);
define('RPMTAG_PACKAGER', 1015);
define('RPMTAG_GROUP', 1016);
define('RPMTAG_CHANGELOG', 1017);
define('RPMTAG_SOURCE', 1018);
define('RPMTAG_PATCH', 1019);
define('RPMTAG_URL', 1020);
define('RPMTAG_OS', 1021);
define('RPMTAG_ARCH', 1022);
define('RPMTAG_PREIN', 1023);
define('RPMTAG_POSTIN', 1024);
define('RPMTAG_PREUN', 1025);
define('RPMTAG_POSTUN', 1026);
define('RPMTAG_FILENAMES', 1027);
define('RPMTAG_FILESIZES', 1028);
define('RPMTAG_FILESTATES', 1029);
define('RPMTAG_FILEMODES', 1030);
define('RPMTAG_FILEUIDS', 1031);
define('RPMTAG_FILEGIDS', 1032);
define('RPMTAG_FILERDEVS', 1033);
define('RPMTAG_FILEMTIMES', 1034);
define('RPMTAG_FILEMD5S', 1035);
define('RPMTAG_FILELINKTOS', 1036);
define('RPMTAG_FILEFLAGS', 1037);
define('RPMTAG_ROOT', 1038);
define('RPMTAG_FILEUSERNAME', 1039);
define('RPMTAG_FILEGROUPNAME', 1040);
define('RPMTAG_EXCLUDE', 1041);
define('RPMTAG_EXCLUSIVE', 1042);
define('RPMTAG_ICON', 1043);
define('RPMTAG_SOURCERPM', 1044);
define('RPMTAG_FILEVERIFYFLAGS', 1045);
define('RPMTAG_ARCHIVESIZE', 1046);
define('RPMTAG_PROVIDES', 1047);
define('RPMTAG_REQUIREFLAGS', 1048);
define('RPMTAG_REQUIRENAME', 1049);
define('RPMTAG_REQUIREVERSION', 1050);
define('RPMTAG_NOSOURCE', 1051);
define('RPMTAG_NOPATCH', 1052);
define('RPMTAG_CONFLICTFLAGS', 1053);
define('RPMTAG_CONFLICTNAME', 1054);
define('RPMTAG_CONFLICTVERSION', 1055);
define('RPMTAG_DEFAULTPREFIX', 1056);
define('RPMTAG_BUILDROOT', 1057);
define('RPMTAG_INSTALLPREFIX', 1058);
define('RPMTAG_EXCLUDEARCH', 1059);
define('RPMTAG_EXCLUDEOS', 1060);
define('RPMTAG_EXCLUSIVEARCH', 1061);
define('RPMTAG_EXCLUSIVEOS', 1062);
define('RPMTAG_AUTOREQPROV', 1063);
define('RPMTAG_RPMVERSION', 1064);
define('RPMTAG_TRIGGERSCRIPT', 1065);
define('RPMTAG_TRIGGERNAME', 1066);
define('RPMTAG_TRIGGERVERSION', 1067);
define('RPMTAG_TRIGGERFLAGS', 1068);
define('RPMTAG_TRIGGERINDEX', 1069);
define('RPMTAG_VERIFYSCRIPT', 1079);
define('RPMTAG_CHANGELOGTIME', 1080);
define('RPMTAG_CHANGELOGNAME', 1081);
define('RPMTAG_CHANGELOGTEXT', 1082);
define('RPMTAG_BROKENMD5', 1083);
define('RPMTAG_PREREQ', 1084);
define('RPMTAG_PREINPROG', 1085);
define('RPMTAG_POSTINPROG', 1086);
define('RPMTAG_PREUNPROG', 1087);
define('RPMTAG_POSTUNPROG', 1088);
define('RPMTAG_BUILDARCHS', 1089);
define('RPMTAG_OBSOLETENAME', 1090);
define('RPMTAG_VERIFYSCRIPTPROG', 1091);
define('RPMTAG_TRIGGERSCRIPTPROG', 1092);
define('RPMTAG_DOCDIR', 1093);
define('RPMTAG_COOKIE', 1094);
define('RPMTAG_FILEDEVICES', 1095);
define('RPMTAG_FILEINODES', 1096);
define('RPMTAG_FILELANGS', 1097);
define('RPMTAG_PREFIXES', 1098);
define('RPMTAG_INSTPREFIXES', 1099);
define('RPMTAG_TRIGGERIN', 1100);
define('RPMTAG_TRIGGERUN', 1101);
define('RPMTAG_TRIGGERPOSTUN', 1102);
define('RPMTAG_AUTOREQ', 1103);
define('RPMTAG_AUTOPROV', 1104);
define('RPMTAG_CAPABILITY', 1105);
define('RPMTAG_SOURCEPACKAGE', 1106);
define('RPMTAG_OLDORIGFILENAMES', 1107);
define('RPMTAG_BUILDPREREQ', 1108);
define('RPMTAG_BUILDREQUIRES', 1109);
define('RPMTAG_BUILDCONFLICTS', 1110);
define('RPMTAG_BUILDMACROS', 1111);
define('RPMTAG_PROVIDEFLAGS', 1112);
define('RPMTAG_PROVIDEVERSION', 1113);
define('RPMTAG_OBSOLETEFLAGS', 1114);
define('RPMTAG_OBSOLETEVERSION', 1115);
define('RPMTAG_DIRINDEXES', 1116);
define('RPMTAG_BASENAMES', 1117);
define('RPMTAG_DIRNAMES', 1118);
define('RPMTAG_ORIGDIRINDEXES', 1119);
define('RPMTAG_ORIGBASENAMES', 1120);
define('RPMTAG_ORIGDIRNAMES', 1121);
define('RPMTAG_OPTFLAGS', 1122);
define('RPMTAG_DISTURL', 1123);
define('RPMTAG_PAYLOADFORMAT', 1124);
define('RPMTAG_PAYLOADCOMPRESSOR', 1125);
define('RPMTAG_PAYLOADFLAGS', 1126);
define('RPMTAG_INSTALLCOLOR', 1127);
define('RPMTAG_INSTALLTID', 1128);
define('RPMTAG_REMOVETID', 1129);
define('RPMTAG_SHA1RHN', 1130);
define('RPMTAG_RHNPLATFORM', 1131);
define('RPMTAG_PLATFORM', 1132);
define('RPMTAG_PATCHESNAME', 1133);
define('RPMTAG_PATCHESFLAGS', 1134);
define('RPMTAG_PATCHESVERSION', 1135);
define('RPMTAG_CACHECTIME', 1136);
define('RPMTAG_CACHEPKGPATH', 1137);
define('RPMTAG_CACHEPKGSIZE', 1138);
define('RPMTAG_CACHEPKGMTIME', 1139);
define('RPMTAG_FILECOLORS', 1140);
define('RPMTAG_FILECLASS', 1141);
define('RPMTAG_CLASSDICT', 1142);
define('RPMTAG_FILEDEPENDSX', 1143);
define('RPMTAG_FILEDEPENDSN', 1144);
define('RPMTAG_DEPENDSDICT', 1145);
define('RPMTAG_SOURCEPKGID', 1146);

// translate header tag to string representation
function rpm_header_tag($tag)
{
	switch ($tag) {
        case RPMTAG_HEADERIMAGE: return 'HEADERIMAGE';
        case RPMTAG_HEADERSIGNATURES: return 'HEADERSIGNATURES';
        case RPMTAG_HEADERIMMUTABLE: return 'HEADERIMMUTABLE';
        case RPMTAG_HEADERREGIONS: return 'HEADERREGIONS';
        case RPMTAG_HEADERI18NTABLE: return 'HEADERI18NTABLE';
        case RPMTAG_SIG_BASE: return 'SIG_BASE';
        case RPMTAG_SIGSIZE: return 'SIGSIZE';
        case RPMTAG_SIGLEMD5_1: return 'SIGLEMD5_1';
        case RPMTAG_SIGPGP: return 'SIGPGP';
        case RPMTAG_SIGLEMD5_2: return 'SIGLEMD5_2';
        case RPMTAG_SIGMD5: return 'SIGMD5';
        case RPMTAG_SIGGPG: return 'SIGGPG';
        case RPMTAG_SIGPGP5: return 'SIGPGP5';
        case RPMTAG_BADSHA1_1: return 'BADSHA1_1';
        case RPMTAG_BADSHA1_2: return 'BADSHA1_2';
        case RPMTAG_PUBKEYS: return 'PUBKEYS';
        case RPMTAG_DSAHEADER: return 'DSAHEADER';
        case RPMTAG_RSAHEADER: return 'RSAHEADER';
        case RPMTAG_SHA1HEADER: return 'SHA1HEADER';
        case RPMTAG_NAME: return 'NAME';
        case RPMTAG_VERSION: return 'VERSION';
        case RPMTAG_RELEASE: return 'RELEASE';
        case RPMTAG_SERIAL: return 'SERIAL';
        case RPMTAG_SUMMARY: return 'SUMMARY';
        case RPMTAG_DESCRIPTION: return 'DESCRIPTION';
        case RPMTAG_BUILDTIME: return 'BUILDTIME';
        case RPMTAG_BUILDHOST: return 'BUILDHOST';
        case RPMTAG_INSTALLTIME: return 'INSTALLTIME';
        case RPMTAG_SIZE: return 'SIZE';
        case RPMTAG_DISTRIBUTION: return 'DISTRIBUTION';
        case RPMTAG_VENDOR: return 'VENDOR';
        case RPMTAG_GIF: return 'GIF';
        case RPMTAG_XPM: return 'XPM';
        case RPMTAG_COPYRIGHT: return 'COPYRIGHT';
        case RPMTAG_PACKAGER: return 'PACKAGER';
        case RPMTAG_GROUP: return 'GROUP';
        case RPMTAG_CHANGELOG: return 'CHANGELOG';
        case RPMTAG_SOURCE: return 'SOURCE';
        case RPMTAG_PATCH: return 'PATCH';
        case RPMTAG_URL: return 'URL';
        case RPMTAG_OS: return 'OS';
        case RPMTAG_ARCH: return 'ARCH';
        case RPMTAG_PREIN: return 'PREIN';
        case RPMTAG_POSTIN: return 'POSTIN';
        case RPMTAG_PREUN: return 'PREUN';
        case RPMTAG_POSTUN: return 'POSTUN';
        case RPMTAG_FILENAMES: return 'FILENAMES';
        case RPMTAG_FILESIZES: return 'FILESIZES';
        case RPMTAG_FILESTATES: return 'FILESTATES';
        case RPMTAG_FILEMODES: return 'FILEMODES';
        case RPMTAG_FILEUIDS: return 'FILEUIDS';
        case RPMTAG_FILEGIDS: return 'FILEGIDS';
        case RPMTAG_FILERDEVS: return 'FILERDEVS';
        case RPMTAG_FILEMTIMES: return 'FILEMTIMES';
        case RPMTAG_FILEMD5S: return 'FILEMD5S';
        case RPMTAG_FILELINKTOS: return 'FILELINKTOS';
        case RPMTAG_FILEFLAGS: return 'FILEFLAGS';
        case RPMTAG_ROOT: return 'ROOT';
        case RPMTAG_FILEUSERNAME: return 'FILEUSERNAME';
        case RPMTAG_FILEGROUPNAME: return 'FILEGROUPNAME';
        case RPMTAG_EXCLUDE: return 'EXCLUDE';
        case RPMTAG_EXCLUSIVE: return 'EXCLUSIVE';
        case RPMTAG_ICON: return 'ICON';
        case RPMTAG_SOURCERPM: return 'SOURCERPM';
        case RPMTAG_FILEVERIFYFLAGS: return 'FILEVERIFYFLAGS';
        case RPMTAG_ARCHIVESIZE: return 'ARCHIVESIZE';
        case RPMTAG_PROVIDES: return 'PROVIDES';
        case RPMTAG_REQUIREFLAGS: return 'REQUIREFLAGS';
        case RPMTAG_REQUIRENAME: return 'REQUIRENAME';
        case RPMTAG_REQUIREVERSION: return 'REQUIREVERSION';
        case RPMTAG_NOSOURCE: return 'NOSOURCE';
        case RPMTAG_NOPATCH: return 'NOPATCH';
        case RPMTAG_CONFLICTFLAGS: return 'CONFLICTFLAGS';
        case RPMTAG_CONFLICTNAME: return 'CONFLICTNAME';
        case RPMTAG_CONFLICTVERSION: return 'CONFLICTVERSION';
        case RPMTAG_DEFAULTPREFIX: return 'DEFAULTPREFIX';
        case RPMTAG_BUILDROOT: return 'BUILDROOT';
        case RPMTAG_INSTALLPREFIX: return 'INSTALLPREFIX';
        case RPMTAG_EXCLUDEARCH: return 'EXCLUDEARCH';
        case RPMTAG_EXCLUDEOS: return 'EXCLUDEOS';
        case RPMTAG_EXCLUSIVEARCH: return 'EXCLUSIVEARCH';
        case RPMTAG_EXCLUSIVEOS: return 'EXCLUSIVEOS';
        case RPMTAG_AUTOREQPROV: return 'AUTOREQPROV';
        case RPMTAG_RPMVERSION: return 'RPMVERSION';
        case RPMTAG_TRIGGERSCRIPT: return 'TRIGGERSCRIPT';
        case RPMTAG_TRIGGERNAME: return 'TRIGGERNAME';
        case RPMTAG_TRIGGERVERSION: return 'TRIGGERVERSION';
        case RPMTAG_TRIGGERFLAGS: return 'TRIGGERFLAGS';
        case RPMTAG_TRIGGERINDEX: return 'TRIGGERINDEX';
        case RPMTAG_VERIFYSCRIPT: return 'VERIFYSCRIPT';
        case RPMTAG_CHANGELOGTIME: return 'CHANGELOGTIME';
        case RPMTAG_CHANGELOGNAME: return 'CHANGELOGNAME';
        case RPMTAG_CHANGELOGTEXT: return 'CHANGELOGTEXT';
        case RPMTAG_BROKENMD5: return 'BROKENMD5';
        case RPMTAG_PREREQ: return 'PREREQ';
        case RPMTAG_PREINPROG: return 'PREINPROG';
        case RPMTAG_POSTINPROG: return 'POSTINPROG';
        case RPMTAG_PREUNPROG: return 'PREUNPROG';
        case RPMTAG_POSTUNPROG: return 'POSTUNPROG';
        case RPMTAG_BUILDARCHS: return 'BUILDARCHS';
        case RPMTAG_OBSOLETENAME: return 'OBSOLETENAME';
        case RPMTAG_VERIFYSCRIPTPROG: return 'VERIFYSCRIPTPROG';
        case RPMTAG_TRIGGERSCRIPTPROG: return 'TRIGGERSCRIPTPROG';
        case RPMTAG_DOCDIR: return 'DOCDIR';
        case RPMTAG_COOKIE: return 'COOKIE';
        case RPMTAG_FILEDEVICES: return 'FILEDEVICES';
        case RPMTAG_FILEINODES: return 'FILEINODES';
        case RPMTAG_FILELANGS: return 'FILELANGS';
        case RPMTAG_PREFIXES: return 'PREFIXES';
        case RPMTAG_INSTPREFIXES: return 'INSTPREFIXES';
        case RPMTAG_TRIGGERIN: return 'TRIGGERIN';
        case RPMTAG_TRIGGERUN: return 'TRIGGERUN';
        case RPMTAG_TRIGGERPOSTUN: return 'TRIGGERPOSTUN';
        case RPMTAG_AUTOREQ: return 'AUTOREQ';
        case RPMTAG_AUTOPROV: return 'AUTOPROV';
        case RPMTAG_CAPABILITY: return 'CAPABILITY';
        case RPMTAG_SOURCEPACKAGE: return 'SOURCEPACKAGE';
        case RPMTAG_OLDORIGFILENAMES: return 'OLDORIGFILENAMES';
        case RPMTAG_BUILDPREREQ: return 'BUILDPREREQ';
        case RPMTAG_BUILDREQUIRES: return 'BUILDREQUIRES';
        case RPMTAG_BUILDCONFLICTS: return 'BUILDCONFLICTS';
        case RPMTAG_BUILDMACROS: return 'BUILDMACROS';
        case RPMTAG_PROVIDEFLAGS: return 'PROVIDEFLAGS';
        case RPMTAG_PROVIDEVERSION: return 'PROVIDEVERSION';
        case RPMTAG_OBSOLETEFLAGS: return 'OBSOLETEFLAGS';
        case RPMTAG_OBSOLETEVERSION: return 'OBSOLETEVERSION';
        case RPMTAG_DIRINDEXES: return 'DIRINDEXES';
        case RPMTAG_BASENAMES: return 'BASENAMES';
        case RPMTAG_DIRNAMES: return 'DIRNAMES';
        case RPMTAG_ORIGDIRINDEXES: return 'ORIGDIRINDEXES';
        case RPMTAG_ORIGBASENAMES: return 'ORIGBASENAMES';
        case RPMTAG_ORIGDIRNAMES: return 'ORIGDIRNAMES';
        case RPMTAG_OPTFLAGS: return 'OPTFLAGS';
        case RPMTAG_DISTURL: return 'DISTURL';
        case RPMTAG_PAYLOADFORMAT: return 'PAYLOADFORMAT';
        case RPMTAG_PAYLOADCOMPRESSOR: return 'PAYLOADCOMPRESSOR';
        case RPMTAG_PAYLOADFLAGS: return 'PAYLOADFLAGS';
        case RPMTAG_INSTALLCOLOR: return 'INSTALLCOLOR';
        case RPMTAG_INSTALLTID: return 'INSTALLTID';
        case RPMTAG_REMOVETID: return 'REMOVETID';
        case RPMTAG_SHA1RHN: return 'SHA1RHN';
        case RPMTAG_RHNPLATFORM: return 'RHNPLATFORM';
        case RPMTAG_PLATFORM: return 'PLATFORM';
        case RPMTAG_PATCHESNAME: return 'PATCHESNAME';
        case RPMTAG_PATCHESFLAGS: return 'PATCHESFLAGS';
        case RPMTAG_PATCHESVERSION: return 'PATCHESVERSION';
        case RPMTAG_CACHECTIME: return 'CACHECTIME';
        case RPMTAG_CACHEPKGPATH: return 'CACHEPKGPATH';
        case RPMTAG_CACHEPKGSIZE: return 'CACHEPKGSIZE';
        case RPMTAG_CACHEPKGMTIME: return 'CACHEPKGMTIME';
        case RPMTAG_FILECOLORS: return 'FILECOLORS';
        case RPMTAG_FILECLASS: return 'FILECLASS';
        case RPMTAG_CLASSDICT: return 'CLASSDICT';
        case RPMTAG_FILEDEPENDSX: return 'FILEDEPENDSX';
        case RPMTAG_FILEDEPENDSN: return 'FILEDEPENDSN';
        case RPMTAG_DEPENDSDICT: return 'DEPENDSDICT';
        case RPMTAG_SOURCEPKGID: return 'SOURCEPKGID';
		default: return "RPMTAG_UNKNOWN ($tag)";
	}
}

?>