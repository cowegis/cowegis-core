# Changelog

## 1.1.0 - 2026-09-02

### Added

- `ControlSchema` + `ControlSchemaDescriber` base and concrete describers for all
  seven core controls (`zoom`, `scale`, `attribution`, `fullscreen`, `geocoder`,
  `layers`, `loading`).
- `OverpassLayerSchemaDescriber`.
- Reusable `Error` schema, `ErrorSchemaDescriber` and `ProblemResponses` factory;
  `404` responses on the map and marker-data operations.
- `presets` (`icons`/`popups`/`styles`/`tooltips`) on `MapSchema`.

### Changed

- The `GET /map/{mapId}` and `GET /map/{mapId}/markers/{layerId}` responses are now
  modelled as the real `{map,assets}` / `{data,assets}` envelopes.
- Path parameters renamed `definitionId` → `mapId` to match the routes.

### Fixed

- `MapSchema.controls` no longer emits an invalid empty `oneOf`.
- Removed the `assets` property that `MapSchema` described but the API never returned.
