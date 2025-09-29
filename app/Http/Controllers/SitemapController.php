<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class SitemapController extends Controller
{
    public function index()
    {
        $locales = ['en', 'fr', 'es', 'it', 'de', 'pt-br', 'zh-cn', 'ko', 'ru'];

        $pages = [
            '/',
            '/privacy-policy',
            '/calculator',
            '/budget-planner',
            '/money-calculator',
            '/50-30-20',
            '/retirement-savings-calculator',
            '/debt-payoff-calculator',
            '/investment-calculator',
            '/compound-interest-calculator',
            '/percentage-calculator',
            '/percent-difference-calculator',
            '/percentage-change-calculator',
            '/bmi',
            '/pdf-free',
            '/pdf-budget-planner',
            '/pdf-money-calculator',
            '/pdf-50-30-20',
            '/pdf-retirement-savings-calculator'
        ];

        $sitemap = $this->generateSitemap($locales, $pages);

        return response($sitemap)->header('Content-Type', 'application/xml');
    }

    private function generateSitemap($locales, $pages)
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Use a fixed date for SEO-friendly lastmod
        $fixedDate = Carbon::createFromDate(2025, 9, 1); // example: first of this month

        foreach ($pages as $page) {
            foreach ($locales as $locale) {
                $url = $locale == 'en' ? url($page) : url("/$locale$page");
                $url = str_replace('http://', 'https://', $url);

                $sitemap .= '<url>';
                $sitemap .= '<loc>' . htmlspecialchars($url) . '</loc>';
                $sitemap .= '<lastmod>' . $fixedDate->toAtomString() . '</lastmod>';

                // Use realistic changefreq
                $changefreq = in_array($page, ['/calculator', '/budget-planner', '/money-calculator']) ? 'weekly' : 'monthly';
                $sitemap .= '<changefreq>' . $changefreq . '</changefreq>';

                // Priority based on importance
                $priority = ($page == '/') ? '1.0' : '0.8';
                $sitemap .= '<priority>' . $priority . '</priority>';

                $sitemap .= '</url>';
            }
        }

        $sitemap .= '</urlset>';

        return $sitemap;
    }
}
