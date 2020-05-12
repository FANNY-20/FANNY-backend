# CHANGELOG

## `0.1.1` (05-12-2020)

Update README:
    - Add "Composer" as a prerequisite (used to install project dependencies)
    - Remove unused php extension
    
The project should be fully deployable without broken dependencies (due to internally hosted dependencies).

## `0.1.0` (05-07-2020)

First release of the FANNY backend, including:

- A route to send geolocations
- A route to send tokens
- A route to get tokens
- A job to clear expired meets
- A job to clear expired tokens
- A job to clear expired geolocations
