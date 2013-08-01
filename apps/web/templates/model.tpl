class {%$mod%}Model extends Model {

		public function get_list($map = '',  $field = '*', $order = 'uid desc', $limit = 30) {
			$user = M({%$table%});
			$user->where($map)->field($field)->order($order);
			if($map == ''){
				$res    = $user->findPage($limit);
			}else{
				$key = key($map);
				$val = str_replace('%', '', $map[$key][1]);
				$res    = $user->findPage($limit, false, array(), '&' . $key . '=' . $val );
			}

			return $res;
		}

		public function get_info($id){
			$table	= M({%$table%});
			$data 	= $table->where(array( '{%$index_field%}' => $id))->findAll();
			return $data;
		}
		
		public function delete($id){
			$table	= M({%$table%});
			$data 	= $table->where(array( '{%$index_field%}' => $id))->delete();
			return $data;
		}

		public function update($id, $fields){
			$table	= M({%$table%});
			$data 	= $table->where(array( '{%$index_field%}' => $id))->save($fields);
			return $data;
		}

		public function add($fields){
			$table	= M({%$table%});
			$data 	= $table->add($fields);
			return $data;
		}
}
