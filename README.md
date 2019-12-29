# REST key-val store

This is a RESTful API that supports the following HTTP requests:


### These are the following endpoints:

#### GET /api/values
Get all the values of the store.

```
response: {key1: value1, key2: value2, key3: value3...}
```

#### GET /api/values?keys=key1,key2
Get one or more specific values from the store.

```
response: {key1: value1, key2: value2}
```

#### POST /api/values
Save a value in the store.

```
request: {key1: value1, key2: value2..}
response: {key1: value1, key2: value2..}
```

#### PATCH /api/values
Update a value in the store.

```
request: {key1: value5, key2: value3..}
response: {key1: value5, key2: value3..}
```
