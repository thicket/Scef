<?php

class posts extends L_mysql {

    public $data = array();
    public $dataRow = 0;

    function __construct() {
        parent::__construct();
        $this->init('posts');
        $this->dataRow = 30;
    }

    public function chk_insert() {
        $data['domain'] = chk_input('domain', 'post');
        $data['status'] = chk_input('status', 'post');
        $data['level'] = chk_input('level', 'post');
        $data['status'] = chk_input('status', 'post');
        $data['descripton'] = chk_input('descripton', 'post');

        $cnt = count($data);
        $data = array_filter($data);

        if (empty($data) || ($cnt != count($data))) {
            throw new Exception('请把数据填写完整');
        }

        $data = chk_str_to_sql($data);

        $data['create_time'] = 'NOW()';

        return $data;
    }

    public function chk_update() {
        $data['domain'] = chk_input('domain', 'post');
        $data['status'] = chk_input('status', 'post');
        $data['level'] = chk_input('level', 'post');
        $data['status'] = chk_input('status', 'post');
        $data['descripton'] = chk_input('descripton', 'post');

        $data = array_filter($data);

        if (empty($data)) {
            throw new Exception('请把数据填写完整');
        }

        $data = chk_str_to_sql($data);

        return $data;
    }

    /**
     * 获取提供分页的数据
     */
    public function getPage($index = 0) {
        $this->init('posts');
        $this->set_where(array('post_type="post"','post_status="publish"'));
        $this->set_order('post_date DESC');
        $this->set_limit(' LIMIT ' . $index * $this->dataRow . ',' . $this->dataRow);
        $this->select();
        $this->query();
        return $this->fetch_array('','ID');
    }

    /**
     * 设置行
     */
    public function setDataRow($dataRow) {
        $this->dataRow = $dataRow;
    }
    
    
    /**
     * 获取标签
     */
    public function getTag($ids){
        $ids = (array)$ids;
        $this->init('posts');
        $this->set_from('wp_term_relationships wtr');
        $this->set_join('LEFT JOIN wp_term_taxonomy wtt ON ( wtt.term_taxonomy_id = wtr.term_taxonomy_id )');
        $this->set_join('LEFT JOIN wp_terms wt ON ( wt.term_id = wtt.term_id )');
        $this->set_where(array('wtr.object_id in('.join(',',$ids).')','wtt.taxonomy="post_tag"'));
        $this->select();
        $this->query();
        return $this->fetch_array('','object_id',1);
    }
    
    
    
    /**
     * 获取所属分类
     */
    public function getCate($ids){
        $ids = (array)$ids;
        $this->init('posts');
        $this->set_from('wp_term_relationships wtr');
        $this->set_join('LEFT JOIN wp_term_taxonomy wtt ON ( wtt.term_taxonomy_id = wtr.term_taxonomy_id )');
        $this->set_join('LEFT JOIN wp_terms wt ON ( wt.term_id = wtt.term_id )');
        $this->set_where(array('wtr.object_id in('.join(',',$ids).')','wtt.taxonomy="category"'));
        $this->select();
        $this->query();
        return $this->fetch_array('','object_id',1);
    }
    
    
    
    /**
     * 获取链接分类
     */
    public function getLinkCate($ids){
        $ids = (array)$ids;
        $this->init('posts');
        $this->set_from('wp_term_relationships wtr');
        $this->set_join('LEFT JOIN wp_term_taxonomy wtt ON ( wtt.term_taxonomy_id = wtr.term_taxonomy_id )');
        $this->set_join('LEFT JOIN wp_terms wt ON ( wt.term_id = wtt.term_id )');
        $this->set_where(array('wtr.object_id in('.join(',',$ids).')','wtt.taxonomy="link_category"'));
        $this->select();
        $this->query();
        return $this->fetch_array('','object_id',1);
    }

}