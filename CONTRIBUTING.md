# Contributing to Messenger

Messenger is an open source project. If you'd like to contribute, please read the following text. Before I can merge your 
Pull-Request here are some guidelines that you need to follow. These guidelines exist not to annoy you, but to keep the 
code base clean, unified and future proof.

## Branch

You should only open pull requests against the `master` branch.
Please use the provided Pull-Request template when submitting your PR and make sure you go through and check our `Pre Code Review` checklist.

## Unit Tests

Please try to add a test for your pull-request. You can run the unit-tests by calling:

```bash
./vendor/bin/phpunit tests/
```

## Travis

GitHub automatically run your pull request through Travis CI.
If you break the tests, I cannot merge your code, so please make sure that your code is working before opening up a Pull-Request.

## Merge

Please give me time to review your pull requests. I will give my best to review everything as fast as possible, but cannot always live up to my own expectations.

## Coding Standards

When contributing code to Messenger, you must follow its coding standards.

[More about PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Documentation

Make sure the `README.md` and any other relevant documentation are kept up-to-date.

---

Thank you very much again for your contribution!