<h1 align="center">
  <br>
    <img src="https://i.imgur.com/d8QEHRb.png" alt="Tradução Magento 2 pt_BR" width="128" height="128" title="Magento2 quicklink"/> 
  <br>
  Magento 2 Quicklink Module
  <br>
</h1>

#### Faster subsequent page-loads by prefetching in-viewport links during idle time

<p align="center">  
  <a href="https://packagist.org/packages/rafaelcg/quicklink-magento2"><img src="https://img.shields.io/packagist/dt/rafaelcg/quicklink-magento2.svg" alt="Total Downloads"></a>
</p>

## How it works

Magento 2 Quicklink module attempts to make navigations to subsequent pages load faster. It:

* **Detects links within the viewport** (using [Intersection Observer](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API))
* **Waits until the browser is idle** (using [requestIdleCallback](https://developer.mozilla.org/en-US/docs/Web/API/Window/requestIdleCallback))
* **Checks if the user isn't on a slow connection** (using `navigator.connection.effectiveType`) or has data-saver enabled (using `navigator.connection.saveData`)
* **Prefetches URLs to the links** (using [`<link rel=prefetch>`](https://www.w3.org/TR/resource-hints/#prefetch) or XHR). Provides some control over the request priority (can switch to `fetch()` if supported).

## Install

### Via Composer 

Install using [Composer](https://getcomposer.org).

```
composer require rafaelcg/quicklink-magento2
php bin/magento setup:static-content:deploy -f
php bin/magento cache:clean
```

## How to use

After installation, it will be enabled by default. You can find the configuration into `Stores > Configuration > General Web > Google Quicklink`.

[Rafael Corrêa Gomes](https://github.com/rafaelstz)
