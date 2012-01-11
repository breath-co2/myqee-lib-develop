<?php
namespace Library\MyQEE\Develop;

/**
 * Debug类库
 *
 * @author     jonwang(jonwang@myqee.com)
 * @category   Library
 * @package    MyQEE
 * @subpackage Classes
 * @copyright  Copyright (c) 2008-2012 myqee.com
 * @license    http://www.myqee.com/license.html
 */
class Debug extends \FB
{

    /**
     * @var Debug
     */
    protected static $instance = null;

    public static function instance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new Debug();
        }
        return static::$instance;
    }

    /**
     * @return Profiler
     */
    public function profiler($type='default')
    {
        return Debug\Profiler::instance($type);
    }

    /**
     * 开启Xhprof调试信息
     */
    public function xhprof_start($type = null)
    {
        $profiler = $this->profiler('xhprof');
        if (true===$profiler->is_open())
        {
            $xhprof_fun = 'xhprof_enable';
            if ( \function_exists($xhprof_fun) )
            {
                $xhprof_fun( $type );
            }
            $profiler->start('Xhprof', $type === null?'default':'Type:'.$type);
        }
    }

    /**
     * 停止Xhprof调试信息
     */
    public function xhprof_stop()
    {
        $profiler = $this->profiler('xhprof');
        if ( true === $profiler->is_open() )
        {
            $xhprof_fun = '\\xhprof_disable';
            if ( \function_exists($xhprof_fun) )
            {
                $data = $xhprof_fun();
            }
            else
            {
                $data = null;
            }
            $profiler->stop();
            return $data;
        }
    }

    public function __call( $m, $v )
    {
        return $this;
    }
}