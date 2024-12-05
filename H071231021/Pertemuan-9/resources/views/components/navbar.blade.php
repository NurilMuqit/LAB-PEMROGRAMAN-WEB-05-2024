<nav class="bg-blue-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="text-2xl font-bold">Inventory System</a>
        <div class="flex space-x-4">
            <a href="{{ route('products.index') }}" class="hover:text-gray-300">Products</a>
            <a href="{{ route('categories.index') }}" class="hover:text-gray-300">Categories</a>
            <a href="{{ route('inventory_logs.index') }}" class="hover:text-gray-300">Inventory Logs</a>
        </div>
    </div>
</nav>
