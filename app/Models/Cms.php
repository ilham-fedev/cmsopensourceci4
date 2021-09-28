<?php
namespace App\Models;
use Config\Database;

class Cms{
    /**
     * Atrribute
     * db : Database Connect Query Builder Codeigniter
     * limit = limit of rows
     * offset = offset of rows
     */
    private $db;
    public $limit = 15;
    public $offset= 0;
    public $order = [
        'order_by' => 'id',
        'sort'     => 'DESC'
    ];
    public $filter = [];
    public $withLike = false;

    /**
     * __construct
     */
    function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * getActiveThemes
     * get active themes on table
     */
    public function getActiveThemes()
    {
        return $this->db
                ->table('templates')
                ->select('folder')
                ->where('aktif','Y')
                ->get()
                ->getRow();
    }

    /**
     * getIdentity
     */
    public function findIdentity()
    {
        return $this->db
                ->table('identitas')
                ->get()
                ->getRow();
    }

    /**
     * getBanner
     */
    public function getBanner()
    {
        return $this->db
                ->table('banner')
                ->get()
                ->getResult();
    }
    /**
     * findPage
     */
    public function findPage($seo)
    {
        return $this->db
                ->table('halaman')
                ->where('halaman_seo', $seo)
                ->get()
                ->getRow();
    }

    /**
     * getNews
     */
    public function getNews()
    {
        $order_by = $this->order['order_by'];
        $sort     = $this->order['sort'];

        $news = $this->db
                ->table('berita')
                ->select('berita.*, kategori_seo')
                ->join('kategori','kategori.id=berita.id_kategori','left');
        
        if(count($this->filter) > 0 && $this->withLike === false)
        {
            foreach($this->filter as $key => $value)
            {
                $news->where($key,$value);
            }
        }

        if(count($this->filter) > 0 && $this->withLike === true)
        {
            foreach($this->filter as $key => $value)
            {
                $news->like($key,$value);
            }
        }

        $news->orderBy($order_by, $sort)->orderBy('tanggal', 'DESC');

        if($this->offset == 0)
        {
            $news = $news->limit($this->limit);
        }else{
            $news = $news->limit($this->offset, $this->limit);
        }

        return $news->get()->getResult();
    }

    /**
     * findNews
     */
    public function findNews($seo)
    {

        $read = $this->db
                ->table('berita')
                ->where('judul_seo', $seo)
                ->get()
                ->getRow();

        $this->updateHits($read);

        return $read;
    }

    /**
     * updateHits
     */
    private function updateHits($news)
    {
        $dibaca = ($news->dibaca)+1;
        $data = [
            'dibaca' => $dibaca
        ];

        $this->db
        ->table('berita')
        ->where([
            'id' => $news->id
        ])->update($data);
    }

    /**
     * getCategoiries
     */
    public function getCategories()
    {
        $categories = $this->db
                    ->table('kategori')
                    ->orderBy('id', 'DESC');

        if($this->offset == 0)
        {
            $categories = $categories->limit($this->limit);
        }else{
            $categories = $categories->limit($this->offset, $this->limit);
        }

        return $categories->get()->getResult();
    }

    /**
     * getTags
     */
    public function getTags()
    {
        $tags = $this->db
                    ->table('tag')
                    ->orderBy('id', 'DESC');

        if($this->offset == 0)
        {
            $tags = $tags->limit($this->limit);
        }else{
            $tags = $tags->limit($this->offset, $this->limit);
        }

        return $tags->get()->getResult();
    }

    /**
     * getTags
     */
    public function getAgenda()
    {
        $tags = $this->db
                    ->table('agenda')
                    ->orderBy('id', 'DESC');

        if($this->offset == 0)
        {
            $tags = $tags->limit($this->limit);
        }else{
            $tags = $tags->limit($this->offset, $this->limit);
        }

        return $tags->get()->getResult();
    }

    /**
     * findAgenda
     */
    public function findAgenda($seo)
    {
        $agenda = $this->db
                    ->table('agenda')
                    ->where('tema_seo', $seo);

        return $agenda->get()->getRow();
    }

    /**
     * getPinned
     */
    public function getPinned()
    {
        $pinned = $this->db
                  ->table('pinned')
                  ->orderBy('id', 'DESC')
                  ->get()
                  ->getRow();

        return $pinned;
    }

    /**
     * getGaleri
     */
    public function getGaleri()
    {
        $tags = $this->db
                    ->table('album')
                    ->orderBy('id', 'DESC');

        if($this->offset == 0)
        {
            $tags = $tags->limit($this->limit);
        }else{
            $tags = $tags->limit($this->offset, $this->limit);
        }

        return $tags->get()->getResult();
    }

    /**
     * findGaleri
     */
    public function findGaleri($seo)
    {
        $galeri = $this->db
                ->table('album')
                ->where('album_seo', $seo)
                ->get()
                ->getRow();

        $photos = $this->db
                  ->table('galeri')
                  ->where('id_album', $galeri->id)
                  ->orderBy('id', 'DESC')
                  ->get()
                  ->getResult();


        return [
            'galeri' => $galeri,
            'photos' => $photos
        ];
    }

    /**
     * findPhoto
     */
    public function findPhoto($seo)
    {
        $photo = $this->db
                    ->table('galeri')
                    ->where('galeri_seo', $seo);

        return $photo->get()->getRow();
    }

    /**
     * getDownload
     */
    public function getDownload()
    {
        $download = $this->db
                    ->table('download')
                    ->orderBy('id', 'DESC');

        return $download->get()->getResult();
    }

    /**
     * getContact
     */
    public function getContact()
    {
        return $this->db
                ->table('hubungi')
                ->where("id", 1)
                ->get()
                ->getRow();
    }

    /**
     * getSearch
     */
    public function getSearch($words)
    {
        $tags = $this->db
                    ->table('berita')
                    ->like('judul',$words)
                    ->orLike('tag', $words)
                    ->orderBy('id', 'DESC');

        if($this->offset == 0)
        {
            $tags = $tags->limit($this->limit);
        }else{
            $tags = $tags->limit($this->offset, $this->limit);
        }

        return $tags->get()->getResult();
    }
    /**
     * getMenu
     */
    public function getMenu()
    {
        $sql = "SELECT mainmenu.id,nama_menu,link,GROUP_CONCAT(CONCAT(nama_sub,'|',link_sub)) AS child 
                FROM mainmenu 
                LEFT JOIN submenu ON submenu.id_main=mainmenu.id 
                WHERE mainmenu.adminmenu='N'
                GROUP BY id";

        return $this->db
                ->query($sql)
                ->getResult();
    }

    /**
     * getStatistikKunjungan
     */
    public function getStatistikKunjungan()
    {
        $ip     = $_SERVER['REMOTE_ADDR'];
        $date   = date("Y-m-d h:i:s");
        $online = time();

        $has = $this->db
               ->table("statistik")
               ->where([
                   'DATE(created_at)' => date("Y-m-d"),
                   'ip' => $ip
               ])
               ->get()
               ->getRow();
        if($has)
        {
            $hits = ($has->hits)+1;
            $data = [
                'created_at' => $date,
                'online'     => $online,
                'hits'       => $hits
            ];
            $save = $this->db
                    ->table("statistik")
                    ->where([
                        'ip' => $ip,
                        'DATE(created_at)' => date("Y-m-d")
                    ])
                    ->update($data);
            
            return true;
        }
        $data = [
            'created_at' => $date,
            'online'     => $online,
            'hits'       => 1,
            'ip'         => $ip
        ];
        $save = $this->db
                ->table("statistik")
                ->insert($data);

        return true;
    }

    /**
     * getKunjungan
     */
    public function getKunjungan()
    {
        $table = $this->db
               ->table("statistik");

        $days = $table
        ->where([
            'DAY(created_at)' => date('d')
        ])
        ->countAllResults();

        $month = $table
        ->where([
            'MONTH(created_at)' => date('m')
        ])
        ->countAllResults();

        $all = $table->countAllResults();
        return [
            'days' => $days,
            'month'=> $month,
            'all'  => $all
        ];
    }
}