## Promo Code

![GitHub Workflow Status](https://img.shields.io/github/workflow/status/CyberSai/promo/Laravel)

Promo Code API allow you to generate Promo code for an events.

## Usage

The base uri is `http://localhost:8000/api/v1`

### Creating New Event
#### Request
``` bash
curl --request POST \
  --url http://localhost:8000/api/v1/events \
  --header 'Content-Type: application/json' \
  --data '{
	"name": "Event 1",
	"description": "Long Description",
	"date": "2021-06-21",
	"coordinate" : {
		"lat": 9.0,
		"lng": 2.2
	}
}'
```
#### Response (201)
``` json
{
  "data": {
    "id": 1,
    "name": "Event 1",
    "description": "Long Description",
    "date": "2021-06-21",
    "coordinate": {
      "lat": 9,
      "lng": 2.2
    },
    "created_at": "2021-06-07T14:18:30.000000Z",
    "updated_at": "2021-06-07T14:18:30.000000Z"
  }
}
```

#### Response (422)
``` json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ]
  }
}
```

### Listing All Events
#### Request
``` bash
curl --request GET \
  --url http://localhost:8000/api/v1/events
```
#### Response (200)
``` json
{
  "data": [
    {
      "id": 1,
      "name": "Event 1",
      "description": "Long Description",
      "date": "2021-06-21",
      "coordinate": {
        "lat": 9,
        "lng": 2.2
      },
      "created_at": "2021-06-07T14:18:30.000000Z",
      "updated_at": "2021-06-07T14:18:30.000000Z"
    }
  ],
  "links": {
    "first": "http:\/\/localhost:8000\/api\/v1\/events?page=1",
    "last": null,
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "path": "http:\/\/localhost:8000\/api\/v1\/events",
    "per_page": 15,
    "to": 1
  }
}
```

### Creating New Promo Code for an event
#### Request
``` bash
curl --request POST \
  --url http://localhost:8000/api/v1/events/1/promos \
  --header 'Content-Type: application/json' \
  --data '{
	"amount": 10,
	"radius": 5
}'
```
#### Response (201)
``` json
{
  "data": {
    "id": 3,
    "code": "ni-q65-8iOw-bdI6T-jd",
    "amount": "10.00",
    "active": true,
    "radius": 5,
    "event": {
      "id": 1,
      "name": "Event 1",
      "description": "Long Description",
      "date": "2021-06-21",
      "coordinate": {
        "lat": 9,
        "lng": 2.2
      },
      "created_at": "2021-06-07T14:18:30.000000Z",
      "updated_at": "2021-06-07T14:18:30.000000Z"
    },
    "created_at": "2021-06-07T14:35:29.000000Z",
    "updated_at": "2021-06-07T14:35:29.000000Z"
  }
}
```
#### Response (422)
``` json
{
  "message": "The given data was invalid.",
  "errors": {
    "amount": [
      "The amount field is required."
    ]
  }
}
```

### Listing All Promo Code for an event
#### Request
``` bash
curl --request GET \
  --url http://localhost:8000/api/v1/events/1/promos
```
#### Response (200)
``` json
{
  "data": [
    {
      "id": 1,
      "code": "mx-cTD-U1fR-T9vqY-9s",
      "amount": "10.00",
      "active": false,
      "radius": 5,
      "created_at": "2021-06-07T14:32:19.000000Z",
      "updated_at": "2021-06-07T14:49:02.000000Z"
    },
    {
      "id": 2,
      "code": "LP-wnp-fWch-b4ksW-8U",
      "amount": "10.00",
      "active": true,
      "radius": 5,
      "created_at": "2021-06-07T14:33:55.000000Z",
      "updated_at": "2021-06-07T14:33:55.000000Z"
    },
    {
      "id": 3,
      "code": "ni-q65-8iOw-bdI6T-jd",
      "amount": "10.00",
      "active": true,
      "radius": 5,
      "created_at": "2021-06-07T14:35:29.000000Z",
      "updated_at": "2021-06-07T14:35:29.000000Z"
    }
  ],
  "links": {
    "first": "http:\/\/localhost:8000\/api\/v1\/events\/1\/promos?page=1",
    "last": null,
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "path": "http:\/\/localhost:8000\/api\/v1\/events\/1\/promos",
    "per_page": 15,
    "to": 3
  }
}
```
### Deactivating Promo Code
#### Request
``` bash
curl --request POST \
  --url http://localhost:8000/api/v1/promos/deactivate \
  --header 'Content-Type: application/json' \
  --data '{
	"code": "mx-cTD-U1fR-T9vqY-9s"
}'
```
#### Response (204)
``` json

```
### Listing Active Promo Codes
#### Request
``` bash
curl --request GET \
  --url http://localhost:8000/api/v1/events/1/promos/active
```
#### Response (200)
``` json
{
  "data": [
    {
      "id": 2,
      "code": "LP-wnp-fWch-b4ksW-8U",
      "amount": "10.00",
      "active": true,
      "radius": 5,
      "created_at": "2021-06-07T14:33:55.000000Z",
      "updated_at": "2021-06-07T14:33:55.000000Z"
    },
    {
      "id": 3,
      "code": "ni-q65-8iOw-bdI6T-jd",
      "amount": "10.00",
      "active": true,
      "radius": 5,
      "created_at": "2021-06-07T14:35:29.000000Z",
      "updated_at": "2021-06-07T14:35:29.000000Z"
    }
  ],
  "links": {
    "first": "http:\/\/localhost:8000\/api\/v1\/events\/1\/promos\/active?page=1",
    "last": null,
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "path": "http:\/\/localhost:8000\/api\/v1\/events\/1\/promos\/active",
    "per_page": 15,
    "to": 2
  }
}
```
### Verify Promo Code
#### Request
``` bash
curl --request POST \
  --url http://localhost:8000/api/v1/promos/verify \
  --header 'Content-Type: application/json' \
  --data '{
	"code": "mx-cTD-U1fR-T9vqY-9s",
	"origin": {
		"lat": 2,
		"lng": 5
	},
	"destination": {
		"lat": 3,
		"lng": 5
	}
}'
```
#### Response (200)
``` json
{
  "data": {
    "promo": {
      "id": 2,
      "code": "LP-wnp-fWch-b4ksW-8U",
      "amount": "10.00",
      "active": true,
      "radius": 5,
      "event": {
        "id": 1,
        "name": "Event 1",
        "description": "Long Description",
        "date": "2021-06-21",
        "coordinate": {
          "lat": 9,
          "lng": 2.2
        },
        "created_at": "2021-06-07T14:18:30.000000Z",
        "updated_at": "2021-06-07T14:18:30.000000Z"
      },
      "created_at": "2021-06-07T14:33:55.000000Z",
      "updated_at": "2021-06-07T14:33:55.000000Z"
    },
    "polyline": {
      "type": "LineString",
      "coordinates": [
        [
          2.2,
          9
        ],
        [
          5,
          3
        ]
      ]
    }
  }
}
```
#### Response (422)
``` json
{
  "message": "The given data was invalid.",
  "errors": {
    "inactive": [
      "Promo Code has been deactivated"
    ]
  }
}
```

#### Response (422)
``` json
{
  "message": "The given data was invalid.",
  "errors": {
    "radius": [
      "You are not within the radius of the event"
    ]
  }
}
```
#### Response (422)
``` json
{
  "message": "The given data was invalid.",
  "errors": {
    "expired": [
      "Promo Code has expired since event is in the past"
    ]
  }
}
```
