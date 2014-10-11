<?php
/**
 * Creates the page buttons.
 * @return array a list of page buttons (in HTML code).
 */
class PagerSA extends CLinkPager
{
    const CSS_FIRST_PAGE='first';
    const CSS_LAST_PAGE='last';
    const CSS_PREVIOUS_PAGE='previous';
    const CSS_NEXT_PAGE='next';
    const CSS_INTERNAL_PAGE='page';
    const CSS_HIDDEN_PAGE='hidden';
    const CSS_SELECTED_PAGE='selected';

    /**
     * @var integer maximum number of page buttons that can be displayed. Defaults to 10.
     */
    public $maxButtonCount=5;
    /**
     * @var string the text label for the next page button. Defaults to 'Next &gt;'.
     */
    public $nextPageLabel;
    /**
     * @var string the text label for the previous page button. Defaults to '&lt; Previous'.
     */
    public $prevPageLabel;
    /**
     * @var string the text label for the first page button. Defaults to '&lt;&lt; First'.
     */
    public $firstPageLabel;
    /**
     * @var string the text label for the last page button. Defaults to 'Last &gt;&gt;'.
     */
    public $lastPageLabel;
    /**
     * @var string the text shown before page buttons. Defaults to 'Go to page: '.
     */
    public $header;
    /**
     * @var string the text shown after page buttons.
     */
    public $footer='';
    /**
     * @var mixed the CSS file used for the widget. Defaults to null, meaning
     * using the default CSS file included together with the widget.
     * If false, no CSS file will be used. Otherwise, the specified CSS file
     * will be included when using this widget.
     */
    public $cssFile;
    /**
     * @var array HTML attributes for the pager container tag.
     */
    public $htmlOptions=array();

    /**
     * Initializes the pager by setting some default property values.
     */
    public function init()
    {
        if($this->nextPageLabel===null)
            $this->nextPageLabel=Yii::t('yii','Следующая &gt;');
        if($this->prevPageLabel===null)
            $this->prevPageLabel=Yii::t('yii','&lt; Предыдущая');
        if($this->firstPageLabel===null)
            $this->firstPageLabel=Yii::t('yii','&lt;&lt; Последняя');
        if($this->lastPageLabel===null)
            $this->lastPageLabel=Yii::t('yii','Последняя &gt;&gt;');
        if($this->header===null)
            $this->header=Yii::t('yii','');

        if(!isset($this->htmlOptions['id']))
            $this->htmlOptions['id']=$this->getId();
        if(!isset($this->htmlOptions['class']))
            $this->htmlOptions['class']='yiiPager';
    }

    /**
     * Creates the page buttons.
     * @return array a list of page buttons (in HTML code).
     */
    protected function createPageButtons()
    {
        $pageCount=$this->getPageCount();
        if(($itemCount=$this->getItemCount())<=0)
            return array();

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // first page
        $buttons[]=$this->createPageButton($this->firstPageLabel,0,self::CSS_FIRST_PAGE,$currentPage<=0,false);

        // prev page
        if(($page=$currentPage-1)<0)
            $page=0;
        $buttons[]=$this->createPageButton($this->prevPageLabel,$page,self::CSS_PREVIOUS_PAGE,$currentPage<=0,false);

        //2 first pages
        if($currentPage==3)
        {
            $buttons[]=$this->createPageButton(1,0,self::CSS_INTERNAL_PAGE,false,0==$currentPage);
            $buttons[]= ' ... ';
        }

        if($currentPage>3)
        {
            $buttons[]=$this->createPageButton(1,0,self::CSS_INTERNAL_PAGE,false,0==$currentPage);
            $buttons[]=$this->createPageButton(2,1,self::CSS_INTERNAL_PAGE,false,1==$currentPage);
            $buttons[]= ' ... ';
        }

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i)
            $buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);

        //3 lasts pages
        if($endPage<$pageCount-2)
        {
            $buttons[]= ' ... ';
            for($i=$pageCount-2;$i<=$pageCount-1;++$i)
                $buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);
        }

        if($endPage==$pageCount-2)
        {
            $buttons[]= ' ... ';
            $buttons[]=$this->createPageButton($pageCount,$pageCount-1,self::CSS_INTERNAL_PAGE,false,$pageCount-1==$currentPage);
        }

        // next page
        if(($page=$currentPage+1)>=$pageCount-1)
            $page=$pageCount-1;
        $buttons[]=$this->createPageButton($this->nextPageLabel,$page,self::CSS_NEXT_PAGE,$currentPage>=$pageCount-1,false);

        // last page
        $buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,self::CSS_LAST_PAGE,$currentPage>=$pageCount-1,false);

        //pagination sizes
        $buttons[]= '&nbsp;&nbsp;&nbsp;&nbsp;'.
            CHtml::label('Показать на странице: ', 'show_count') .
            CHtml::dropDownList('show_count', 0, array(150=>150, 300=>300, 450=>450, 900=>900, 10000=>'Все'));

        return $buttons;
    }

}