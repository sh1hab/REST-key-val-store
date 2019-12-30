# REST key-val store

This is a RESTful API that supports the following HTTP requests:


### These are the following endpoints:

#### GET /values
Get all the values of the store.

```
response: {key1: value1, key2: value2, key3: value3...}
```

#### GET /values?keys=key1,key2
Get one or more specific values from the store.

```
response: {key1: value1, key2: value2}
```

#### POST /values
Save a value in the store.

```
request: {key1: value1, key2: value2..}
response: {message: Keys set successfully}
```

#### PATCH /values
Update a value in the store.

```
request: {key1: value5, key2: value3..}
response: {message: Keys updated successfully}
```
