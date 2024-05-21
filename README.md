
## Self contained reproduceable bug:

```
make init
```

### https://localhost/api/entry_points/1

    api_platform
        normalize_child_class_attribute_groups: true/false

```
{
    "@context": "/api/contexts/EntryPoint",
    "@id": "/api/entry_points/1",
    "@type": "EntryPoint",
    "id": 1,
    "name": "entryClassName 1",
    "joinedTableEntities": [
        "/api/joined_child1s/1",
        "/api/joined_child2s/2"
    ]
}
```

- Serialization OK, `joinedTableEntities` should be iris

### https://localhost/api/entry_points/1?groups[]=normalize_with_attribute_in_parent

    api_platform
        normalize_child_class_attribute_groups: true/false

```
{
    "@context": "/api/contexts/EntryPoint",
    "@id": "/api/entry_points/1",
    "@type": "EntryPoint",
    "id": 1,
    "name": "entryClassName 1",
    "joinedTableEntities": [
        {
            "@id": "/api/joined_child1s/1",
            "@type": "JoinedChild1",
            "name": "child type 1"
        },
        {
            "@id": "/api/joined_child2s/2",
            "@type": "JoinedChild2",
            "name": "child type 2"
        }
    ]
}
```

- Normalization of joined child OK, attribute is found in parent class:

### https://localhost/api/entry_points/1?groups[]=normalize_with_attribute_in_child

    api_platform
        normalize_child_class_attribute_groups: false

```
{
    "@context": "/api/contexts/EntryPoint",
    "@id": "/api/entry_points/1",
    "@type": "EntryPoint",
    "id": 1,
    "name": "entryClassName 1",
    "joinedTableEntities": [
        "/api/joined_child1s/1",
        "/api/joined_child2s/2"
    ]
}
```

Normalization of joined child KO, `normalize_with_attribute_in_child` is indeed a requested group found in child class, but not serialized

### https://localhost/api/entry_points/1?groups[]=normalize_with_attribute_in_child

    api_platform
        normalize_child_class_attribute_groups: true

```
{
    "@context": "/api/contexts/EntryPoint",
    "@id": "/api/entry_points/1",
    "@type": "EntryPoint",
    "id": 1,
    "name": "entryClassName 1",
    "joinedTableEntities": [
        {
            "@id": "/api/joined_child1s/1",
            "@type": "JoinedChild1",
            "customClassTwoField": "custom string 2"
        },
        {
            "@id": "/api/joined_child2s/2",
            "@type": "JoinedChild2",
            "customClassOneField": "custom string 1"
        }
    ]
}
```

Normalization of joined child OK, `normalize_with_attribute_in_child` is now found when searching in `JoinedChild1` and `JoinedChild2` classes.


