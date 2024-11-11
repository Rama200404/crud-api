use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
// Get All Items

public function index()
{
$items = Item::all();
return response()->json($items);
}

// Get Single Item
public function show($id)
{
$item = Item::find($id);
if ($item) {
return response()->json($item);
}
return response()->json(['message' => 'Item not found'], 404);
}

// Create New Item
public function store(Request $request)
{
$validated = $request->validate([
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'quantity' => 'required|integer|min:1',
]);

$item = Item::create($validated);
return response()->json($item, 201);
}

// Update Existing Item
public function update(Request $request, $id)

{
$item = Item::find($id);
if ($item) {
$validated = $request->validate([
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'quantity' => 'required|integer|min:1',
]);

$item->update($validated);
return response()->json($item);
}
return response()->json(['message' => 'Item not found'], 404);
}

// Delete Item
public function destroy($id)
{
$item = Item::find($id);
if ($item) {
$item->delete();
return response()->json(['message' => 'Item deleted']);
}
return response()->json(['message' => 'Item not found'], 404);
}
}