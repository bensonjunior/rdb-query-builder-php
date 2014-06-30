<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/3/14
 * Time: 12:07 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\SqlQueryBuilder\Manipulation;

use NilPortugues\SqlQueryBuilder\Syntax\SyntaxFactory;

/**
 * Class Insert
 * @package NilPortugues\SqlQueryBuilder\Manipulation
 */
class Insert extends BaseQuery
{
    /**
     * @var array
     */
    protected $values = array();

    /**
     * @return string
     */
    public function partName()
    {
        return 'INSERT';
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    public function setValues(array $values)
    {
        $this->values = array_filter($values);

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $columns = array_keys($this->values);

        return SyntaxFactory::createColumns($columns, $this->getTable());
    }
}
