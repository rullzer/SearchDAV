<?php
/**
 * @copyright Copyright (c) 2017 Robin Appelman <robin@icewind.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace SearchDAV\XML;


use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class Scope implements XmlDeserializable {
	/**
	 * @var string
	 *
	 * The scope of the search, either as absolute uri or as a path relative to the
	 * search arbiter.
	 */
	public $href;

	/**
	 * @var string|int 0, 1 or 'infinite'
	 *
	 * How deep the search query should be with 0 being only the scope itself,
	 * 1 being all direct child entries of the scope and infinite being all entries
	 * in the scope collection at any depth.
	 */
	public $depth;

	/**
	 * @param string $href
	 * @param int|string $depth
	 */
	public function __construct($href = '', $depth = 1) {
		$this->href = $href;
		$this->depth = $depth;
	}

	static function xmlDeserialize(Reader $reader) {
		$scope = new self();

		$values = \Sabre\Xml\Deserializer\keyValue($reader);
		$scope->href = $values['{DAV:}href'];
		$scope->depth = $values['{DAV:}depth'];

		return $scope;
	}
}