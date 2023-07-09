<ul id="tree">
    @if(($nodes->count() == 0))
        <button id="add-child-button">Add Child</button>
    @else
        @foreach ($nodes as $node)
            <li data-node-id={{$node->id??null}}>
                <span class="node-name"> {{ $node->title }}</span>
                @include('nodes.children', ['children' => $node->children])
            </li>
        @endforeach
</ul>

@endif
{{-----------------------ADD MODAL-------------------------------}}
<div id="add-modal" style="display: none;">
    <form id="add-node-form" method="POST" action={{route('nodes.store')}}>
        @csrf
        <input type="text" id="add-node-name" name="title" placeholder="Node name">
        <input type="hidden" id="add-parent-id" name="parent_id" value="">
        <button type="submit">Add Node</button>
    </form>
</div>

{{--------------------------------------------EDIT MODAL--------------------------------------------}}
<div id="edit-modal" style="display: none;">
    <form id="edit-node-form" method="POST" action={{ route('nodes.update', ['node' => 'NODE_ID']) }}>
        @csrf
        @method('PUT')

        <input type="text" id="edit-node-name" name="edit_title">
        <button type="submit">Update</button>
    </form>
</div>
{{-----------------------------------------FLOATING OPTIONS-----------------------------------------}}
<div id="floating-options" style="display: none;">
    <ul>
        <li>
            <button id="add-option">Add</button>
        </li>
        <li>
            <button id="edit-option">Edit</button>
        </li>
        <li>
            <button id="delete-option">Delete</button>
        </li>
    </ul>
</div>

<script>
    const tree = document.getElementById('tree');
    const floatingOption = document.getElementById('floating-options');
    const addModal = document.getElementById('add-modal');
    const addChildOption = document.getElementById('add-option');
    const addNodeForm = document.getElementById('add-node-form');
    const parentIdInput = document.getElementById('add-parent-id');

    const editOption = document.getElementById('edit-option');
    const editModal = document.getElementById('edit-modal');
    const editNodeForm = document.getElementById('edit-node-form');
    const editNameInput = document.getElementById('edit-node-name');

    let rightClickedNode = null;
   let clickedElement=null;
    tree.addEventListener('click', function (event) {
        clickedElement = event.target;

        const childNodes = clickedElement.nextElementSibling;
        if (childNodes) {
            if (childNodes.style.display === 'none') {
                childNodes.style.display = 'block';
            } else {
                childNodes.style.display = 'none';
            }
        }
    })

    tree.addEventListener('contextmenu', function (event) {

        event.preventDefault();

         clickedElement = event.target;
        if (clickedElement.classList.contains('node-name')) {
            rightClickedNode = clickedElement.parentElement;
            showFloatingOption(event.clientX, event.clientY);
        }
    });


    function showFloatingOption(x, y) {
        floatingOption.style.position = 'fixed';
        floatingOption.style.left = x + 'px';
        floatingOption.style.top = y + 'px';
        floatingOption.style.display = 'block';
    }


    function hideFloatingOption() {
        floatingOption.style.display = 'none';
    }


    addChildOption.addEventListener('click', function () {
        hideFloatingOption();
        if (rightClickedNode != null) {
            parentIdInput.value = rightClickedNode.dataset.nodeId;
        }
        showModal(addModal);


    });
    editOption.addEventListener('click', function () {
        hideFloatingOption();
        editNameInput.value = clickedElement.textContent;
        const formAction = editNodeForm.getAttribute('action').replace('NODE_ID', rightClickedNode.dataset.nodeId);
        editNodeForm.setAttribute('action', formAction);

        showModal(editModal);


    });


    function showModal($modal) {
        $modal.style.display = 'block';
        $modal.style.position = 'fixed';

    }

</script>
