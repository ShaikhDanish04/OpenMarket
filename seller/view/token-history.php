<style>
    .token-list {
        padding: 1rem;
        max-height: 600px;
        overflow-y: scroll;
    }

    .token {
        padding: .75rem;
        margin-bottom: .75rem;
        border-radius: 5px;
        background: #ededed;
        box-shadow: 1px 1px 5px #aaa;
        text-align: center;
        font-weight: 500px;
        letter-spacing: 8px;
    }

    .token.active {
        background: #1e1e1e;
        color: #fff;
    }

    .token:last-child {
        margin-bottom: 0rem;
    }
</style>

<div class="container">
    <p class="display-4 text-center mt-3">The List of Tokens</p>

    <div class="card">
        <div class="card-body token-list">
            <div class="token">1-1</div>
            <div class="token active">1-2</div>
            <div class="token">1-3</div>
        </div>
    </div>
</div>