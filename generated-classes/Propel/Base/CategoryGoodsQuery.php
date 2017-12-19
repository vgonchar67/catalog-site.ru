<?php

namespace Propel\Base;

use \Exception;
use \PDO;
use Propel\CategoryGoods as ChildCategoryGoods;
use Propel\CategoryGoodsQuery as ChildCategoryGoodsQuery;
use Propel\Map\CategoryGoodsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'category_goods' table.
 *
 *
 *
 * @method     ChildCategoryGoodsQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildCategoryGoodsQuery orderByGoodsId($order = Criteria::ASC) Order by the goods_id column
 *
 * @method     ChildCategoryGoodsQuery groupByCategoryId() Group by the category_id column
 * @method     ChildCategoryGoodsQuery groupByGoodsId() Group by the goods_id column
 *
 * @method     ChildCategoryGoodsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoryGoodsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoryGoodsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoryGoodsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategoryGoodsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategoryGoodsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategoryGoodsQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildCategoryGoodsQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildCategoryGoodsQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildCategoryGoodsQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildCategoryGoodsQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildCategoryGoodsQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildCategoryGoodsQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildCategoryGoodsQuery leftJoinGoods($relationAlias = null) Adds a LEFT JOIN clause to the query using the Goods relation
 * @method     ChildCategoryGoodsQuery rightJoinGoods($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Goods relation
 * @method     ChildCategoryGoodsQuery innerJoinGoods($relationAlias = null) Adds a INNER JOIN clause to the query using the Goods relation
 *
 * @method     ChildCategoryGoodsQuery joinWithGoods($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Goods relation
 *
 * @method     ChildCategoryGoodsQuery leftJoinWithGoods() Adds a LEFT JOIN clause and with to the query using the Goods relation
 * @method     ChildCategoryGoodsQuery rightJoinWithGoods() Adds a RIGHT JOIN clause and with to the query using the Goods relation
 * @method     ChildCategoryGoodsQuery innerJoinWithGoods() Adds a INNER JOIN clause and with to the query using the Goods relation
 *
 * @method     \Propel\CategoryQuery|\Propel\GoodsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategoryGoods findOne(ConnectionInterface $con = null) Return the first ChildCategoryGoods matching the query
 * @method     ChildCategoryGoods findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategoryGoods matching the query, or a new ChildCategoryGoods object populated from the query conditions when no match is found
 *
 * @method     ChildCategoryGoods findOneByCategoryId(int $category_id) Return the first ChildCategoryGoods filtered by the category_id column
 * @method     ChildCategoryGoods findOneByGoodsId(int $goods_id) Return the first ChildCategoryGoods filtered by the goods_id column *

 * @method     ChildCategoryGoods requirePk($key, ConnectionInterface $con = null) Return the ChildCategoryGoods by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryGoods requireOne(ConnectionInterface $con = null) Return the first ChildCategoryGoods matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoryGoods requireOneByCategoryId(int $category_id) Return the first ChildCategoryGoods filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryGoods requireOneByGoodsId(int $goods_id) Return the first ChildCategoryGoods filtered by the goods_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoryGoods[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategoryGoods objects based on current ModelCriteria
 * @method     ChildCategoryGoods[]|ObjectCollection findByCategoryId(int $category_id) Return ChildCategoryGoods objects filtered by the category_id column
 * @method     ChildCategoryGoods[]|ObjectCollection findByGoodsId(int $goods_id) Return ChildCategoryGoods objects filtered by the goods_id column
 * @method     ChildCategoryGoods[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoryGoodsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Base\CategoryGoodsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'catalog-site', $modelName = '\\Propel\\CategoryGoods', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoryGoodsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoryGoodsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoryGoodsQuery) {
            return $criteria;
        }
        $query = new ChildCategoryGoodsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$category_id, $goods_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCategoryGoods|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryGoodsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategoryGoodsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryGoods A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT category_id, goods_id FROM category_goods WHERE category_id = :p0 AND goods_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCategoryGoods $obj */
            $obj = new ChildCategoryGoods();
            $obj->hydrate($row);
            CategoryGoodsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCategoryGoods|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CategoryGoodsTableMap::COL_CATEGORY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CategoryGoodsTableMap::COL_GOODS_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query on the goods_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGoodsId(1234); // WHERE goods_id = 1234
     * $query->filterByGoodsId(array(12, 34)); // WHERE goods_id IN (12, 34)
     * $query->filterByGoodsId(array('min' => 12)); // WHERE goods_id > 12
     * </code>
     *
     * @see       filterByGoods()
     *
     * @param     mixed $goodsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByGoodsId($goodsId = null, $comparison = null)
    {
        if (is_array($goodsId)) {
            $useMinMax = false;
            if (isset($goodsId['min'])) {
                $this->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $goodsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($goodsId['max'])) {
                $this->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $goodsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $goodsId, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Category object
     *
     * @param \Propel\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Propel\Category) {
            return $this
                ->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryGoodsTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Propel\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\Propel\CategoryQuery');
    }

    /**
     * Filter the query by a related \Propel\Goods object
     *
     * @param \Propel\Goods|ObjectCollection $goods The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function filterByGoods($goods, $comparison = null)
    {
        if ($goods instanceof \Propel\Goods) {
            return $this
                ->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $goods->getId(), $comparison);
        } elseif ($goods instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryGoodsTableMap::COL_GOODS_ID, $goods->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGoods() only accepts arguments of type \Propel\Goods or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Goods relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function joinGoods($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Goods');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Goods');
        }

        return $this;
    }

    /**
     * Use the Goods relation Goods object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\GoodsQuery A secondary query class using the current class as primary query
     */
    public function useGoodsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGoods($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Goods', '\Propel\GoodsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCategoryGoods $categoryGoods Object to remove from the list of results
     *
     * @return $this|ChildCategoryGoodsQuery The current query, for fluid interface
     */
    public function prune($categoryGoods = null)
    {
        if ($categoryGoods) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CategoryGoodsTableMap::COL_CATEGORY_ID), $categoryGoods->getCategoryId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CategoryGoodsTableMap::COL_GOODS_ID), $categoryGoods->getGoodsId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the category_goods table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryGoodsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoryGoodsTableMap::clearInstancePool();
            CategoryGoodsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryGoodsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoryGoodsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoryGoodsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoryGoodsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoryGoodsQuery
