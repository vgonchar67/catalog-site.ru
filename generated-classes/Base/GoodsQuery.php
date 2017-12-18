<?php

namespace Base;

use \Goods as ChildGoods;
use \GoodsQuery as ChildGoodsQuery;
use \Exception;
use \PDO;
use Map\GoodsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'goods' table.
 *
 *
 *
 * @method     ChildGoodsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGoodsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGoodsQuery orderByPreviewText($order = Criteria::ASC) Order by the preview_text column
 * @method     ChildGoodsQuery orderByDetailText($order = Criteria::ASC) Order by the detail_text column
 *
 * @method     ChildGoodsQuery groupById() Group by the id column
 * @method     ChildGoodsQuery groupByName() Group by the name column
 * @method     ChildGoodsQuery groupByPreviewText() Group by the preview_text column
 * @method     ChildGoodsQuery groupByDetailText() Group by the detail_text column
 *
 * @method     ChildGoodsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGoodsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGoodsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGoodsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGoodsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGoodsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGoods findOne(ConnectionInterface $con = null) Return the first ChildGoods matching the query
 * @method     ChildGoods findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGoods matching the query, or a new ChildGoods object populated from the query conditions when no match is found
 *
 * @method     ChildGoods findOneById(int $id) Return the first ChildGoods filtered by the id column
 * @method     ChildGoods findOneByName(string $name) Return the first ChildGoods filtered by the name column
 * @method     ChildGoods findOneByPreviewText(string $preview_text) Return the first ChildGoods filtered by the preview_text column
 * @method     ChildGoods findOneByDetailText(string $detail_text) Return the first ChildGoods filtered by the detail_text column *

 * @method     ChildGoods requirePk($key, ConnectionInterface $con = null) Return the ChildGoods by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGoods requireOne(ConnectionInterface $con = null) Return the first ChildGoods matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGoods requireOneById(int $id) Return the first ChildGoods filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGoods requireOneByName(string $name) Return the first ChildGoods filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGoods requireOneByPreviewText(string $preview_text) Return the first ChildGoods filtered by the preview_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGoods requireOneByDetailText(string $detail_text) Return the first ChildGoods filtered by the detail_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGoods[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGoods objects based on current ModelCriteria
 * @method     ChildGoods[]|ObjectCollection findById(int $id) Return ChildGoods objects filtered by the id column
 * @method     ChildGoods[]|ObjectCollection findByName(string $name) Return ChildGoods objects filtered by the name column
 * @method     ChildGoods[]|ObjectCollection findByPreviewText(string $preview_text) Return ChildGoods objects filtered by the preview_text column
 * @method     ChildGoods[]|ObjectCollection findByDetailText(string $detail_text) Return ChildGoods objects filtered by the detail_text column
 * @method     ChildGoods[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GoodsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GoodsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'catalog-site', $modelName = '\\Goods', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGoodsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGoodsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGoodsQuery) {
            return $criteria;
        }
        $query = new ChildGoodsQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildGoods|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GoodsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GoodsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGoods A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, preview_text, detail_text FROM goods WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildGoods $obj */
            $obj = new ChildGoods();
            $obj->hydrate($row);
            GoodsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGoods|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GoodsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GoodsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GoodsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GoodsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoodsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoodsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the preview_text column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviewText('fooValue');   // WHERE preview_text = 'fooValue'
     * $query->filterByPreviewText('%fooValue%', Criteria::LIKE); // WHERE preview_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $previewText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterByPreviewText($previewText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($previewText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoodsTableMap::COL_PREVIEW_TEXT, $previewText, $comparison);
    }

    /**
     * Filter the query on the detail_text column
     *
     * Example usage:
     * <code>
     * $query->filterByDetailText('fooValue');   // WHERE detail_text = 'fooValue'
     * $query->filterByDetailText('%fooValue%', Criteria::LIKE); // WHERE detail_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $detailText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function filterByDetailText($detailText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($detailText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoodsTableMap::COL_DETAIL_TEXT, $detailText, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGoods $goods Object to remove from the list of results
     *
     * @return $this|ChildGoodsQuery The current query, for fluid interface
     */
    public function prune($goods = null)
    {
        if ($goods) {
            $this->addUsingAlias(GoodsTableMap::COL_ID, $goods->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the goods table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GoodsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GoodsTableMap::clearInstancePool();
            GoodsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GoodsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GoodsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GoodsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GoodsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GoodsQuery
