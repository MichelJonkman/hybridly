# Testing

Hybridly provides a few testing macros to reduce the boilerplate needed for the most common assertions.

## `assertHybridProperty`

This method asserts that the given hybrid property exists in the response and is equal to the given value. It accepts the same arguments as `AssertableJson#where`.

## `assertHasHybridProperty`

This method asserts that the given hybrid property exists in the response. It accepts the same arguments as [`AssertableJson#has`](https://laravel.com/docs/9.x/http-tests#asserting-json-attribute-presence-and-absence).

## `assertMissingHybridProperty`

This method asserts that the given hybrid property is missing in the response. It accepts the same arguments as [`AssertableJson#missing`](https://laravel.com/docs/9.x/http-tests#asserting-json-attribute-presence-and-absence).

## `assertHybridView`

This method asserts that the page component of the hybrid response is equal to the given value. Additionally, if `hybridly.testing.ensure_pages_exist` is set to `true`, which it is by default, it will ensure that the page component exists.

To ensure the page component's existence, the paths defined in `hybridly.testing.page_paths` will be used.

## `assertHybridVersion`

This method asserts that the `version` property of the hybrid response is equal to the given value.

## `assertHybridUrl`

This method asserts that the `url` property of the hybrid response is equal to the given value.

## `assertHybridPayload`

This method asserts that the property at the given path is equal to the given value. The path supports dot notation.

## `assertHybrid`

This method accepts a callback that gets an `Hybridly\Testing\Assertable` instance as a parameter. 

`Assertable` extends [`Illuminate\Testing\Fluent\AssertableJson`](https://laravel.com/docs/9.x/http-tests#fluent-json-testing) and is initialized with the hybrid response's payload.

### Usage

```php
use Hybridly\Testing\Assertable;

get('/')->assertHybrid(function (Assertable $hybrid) {
  // ...
});
```

## `assertNotHybrid`

This method simply asserts that the response is not hybrid.

## `hdd`

This method die and dumps the hybrid response's payload. If the response was not hybrid, it dumps the response's body instead.

It also accepts a `$path` parameter. If given, the hybrid property at the given path will be dumped instead.