<nav>
    <details>
      <summary>My things</summary>
      <ul>
          @foreach ($myThings as $thing)
              <li>{{ $thing->name }}</li>
          @endforeach
      </ul>
    </details>
    <details>
      <summary>Repair things</summary>
      <ul>
          @foreach ($repairThings as $thing)
              <li>{{ $thing->name }}</li>
          @endforeach
      </ul>
    </details>
    <details>
      <summary>Work things</summary>
      <ul>
          @foreach ($workThings as $thing)
              <li>{{ $thing->name }}</li>
          @endforeach
      </ul>
    </details>
    <details>
      <summary>Used things</summary>
      <ul>
          @foreach ($usedThings as $thing)
              <li>{{ $thing->name }}</li>
          @endforeach
      </ul>
    </details>
    <details>
      <summary>All things</summary>
      <ul>
          @foreach ($allThings as $thing)
              <li>{{ $thing->name }}</li>
          @endforeach
      </ul>
    </details>
</nav>
