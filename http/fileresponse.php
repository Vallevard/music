<?php

/**
 * ownCloud - App Framework
 *
 * @author Bernhard Posselt
 * @copyright 2012 Bernhard Posselt dev@bernhard-posselt.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


namespace OCA\Music\Http;


use OC\Files\View;
use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Http;

/**
 * A renderer for files
 */
class FileResponse extends Response {

	protected $file;

	/**
	 * @param \OC\Files\Node\File|array $file file
	 * @param int $statusCode the Http status code, defaults to 200
	 */
	public function __construct($file, $statusCode=Http::STATUS_OK) {
		$this->setStatus($statusCode);

		if (is_array($file)) {
			$this->file = $file['content'];
			$this->addHeader('Content-type', $file['mimetype'] .'; charset=utf-8');
		} else {
			$this->file = $file;
			$this->addHeader('Content-type', $file->getMimetype() .'; charset=utf-8');
		}
	}

	/**
	 * Returns the rendered json
	 * @return string the file
	 */
	public function render(){
		if (is_string($this->file)) {
			return $this->file;
		}
		return $this->file->getContent();
	}
}