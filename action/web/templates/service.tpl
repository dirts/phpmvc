class {%$mod%}Service extends BusinessService {
		const PAGE_SIZE_DEFULT  = 20; 
		
		#获取数据列表
		public function get_list( $map = '', $field = '*', $order = '{%$index_field%} ASC', $limit = 30) {
				$res = $this->D('{%$mod%}')->get_list($map, $field, $order, $limit);
				return $res;
		}
		
		#获取数据详情
		public function get_info($id = null){
			if(!$id) return false;
			$res = $this->D('{%$mod%}')->get_info($id);
			return $res;
		}

		#更新数据详情
		public function update($id, $fields){
			$res = $this->D('{%$mod%}')->update($id, $fields);
			return $res;
		}
		
		#删除单条数据
		public function delete($id){
			$res = $this->D('{%$mod%}')->delete($id);
			return $res;
		}
		
		#增加新的数据
		public function add($fields){
			$res = $this->D('{%$mod%}')->add($fields);
			return $res;
		}

}
