<?php

namespace App\Models;

class Menu extends Model
{
	protected $table = 'menus';

	/**
	 * @return array
	 */
	public static function mapMenus()
	{
		$parents = self::query()
			->raw("select menus.*, (select count(distinct m1.id) from menus as m1 where m1.parent_id = menus.id) as children_count from menus");

		return self::recursive($parents);
	}

	/**
	 * @param $menus
	 * @param $parent_id
	 * @return array
	 */
	public static function recursive($menus, $parent_id = null)
	{
		$map = [];

		foreach($menus as $menu) {
			if($menu['parent_id'] == $parent_id) {

				if($menu['children_count']) {
					$menu['children'] = self::recursive($menus, $menu['id']);
				}

				$map[] = $menu;
			}
		}

		return $map;
	}
}