<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513772666.
 * Generated on 2017-12-20 15:24:26 
 */
class PropelMigration_1513772666
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'catalog-site' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `category_product` DROP FOREIGN KEY `category_product_fk_904832`;

ALTER TABLE `category_product` DROP FOREIGN KEY `category_product_fk_0f5ed8`;

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk_904832`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk_0f5ed8`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `product`

  CHANGE `order_empty_quantity` `empty_order` INTEGER;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'catalog-site' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `category_product` DROP FOREIGN KEY `category_product_fk_904832`;

ALTER TABLE `category_product` DROP FOREIGN KEY `category_product_fk_0f5ed8`;

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk_904832`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`);

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk_0f5ed8`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`id`);

ALTER TABLE `product`

  CHANGE `empty_order` `order_empty_quantity` INTEGER;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}