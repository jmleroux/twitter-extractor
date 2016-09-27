# Jmleroux Twitter Extractor

A minimalist application to extract tweets and store them in a database.

The Search API's archive only goes back a few days/weeks. This application is meant to be run in a cron job to store
the results of a search by one or multiple hashtags, so you can always have access to old tweets.

What you will do with this tweets data is totally up to you.

## Retrieve hastags

Example to store tweets about Ziggy The Hydra or AkeneoAroundTheWorld tweets:
```
 bin/console --env=prod jmleroux:twitter:extract ziggyTheHydra akeneoAroundTheWorld
 ```
