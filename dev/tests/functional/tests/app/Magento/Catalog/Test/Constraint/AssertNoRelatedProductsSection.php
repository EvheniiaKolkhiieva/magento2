<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Constraint;

use Magento\Catalog\Test\Fixture\CatalogProductSimple;
use Magento\Catalog\Test\Page\Product\CatalogProductView;
use Mtf\Client\BrowserInterface;
use Mtf\Constraint\AbstractConstraint;
use Mtf\Fixture\InjectableFixture;

/**
 * Class AssertNoRelatedProductsSection
 * Assert that product is not displayed in related products section
 */
class AssertNoRelatedProductsSection extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'middle';
    /* end tags */

    /**
     * Assert that product is not displayed in related products section
     *
     * @param BrowserInterface $browser
     * @param CatalogProductSimple $product
     * @param InjectableFixture[] $relatedProducts
     * @param CatalogProductView $catalogProductView
     * @return void
     */
    public function processAssert(
        BrowserInterface $browser,
        CatalogProductSimple $product,
        array $relatedProducts,
        CatalogProductView $catalogProductView
    ) {
        $browser->open($_ENV['app_frontend_url'] . $product->getUrlKey() . '.html');
        foreach ($relatedProducts as $relatedProduct) {
            \PHPUnit_Framework_Assert::assertFalse(
                $catalogProductView->getRelatedProductBlock()->isRelatedProductVisible($relatedProduct->getName()),
                'Product \'' . $relatedProduct->getName() . '\' is exist in related products.'
            );
        }
    }

    /**
     * Text success product is not displayed in related products section
     *
     * @return string
     */
    public function toString()
    {
        return 'Product is not displayed in related products section.';
    }
}
