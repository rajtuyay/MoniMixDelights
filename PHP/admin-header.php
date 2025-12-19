<style>
    #burgerIcon {
        width: 4%;
        height: 7%;
        display: flex;
        align-items: center;
        justify-content: start;
        top: 0;
        background-color: white;
        text-align: left;
        border: none;
        cursor: pointer;
        z-index: 9999;
        flex: 1;
    }

    #container #search {
        position: fixed;
        width: 80%;
        height: 7vh;
        top: 0;
        right: 0;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #B91EB3;
        /* border: 1px solid black; */
        z-index: 1000;
        transition: width 0.3s ease-in-out;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #container #search h4 {
        flex: 1;
        text-align: right;
        font-weight: 500;
        font-size: 0.9rem;
        top: 0;
        margin: 0;
        margin-right: 10px;
    }
</style>

<div id="search">
    <button type="button" id="burgerIcon" class="burger-icon"><img src="../IMG/burger-icon.png" width="40" height="40" alt=""></button>
    <img src="../IMG/brand-name-monimix-nobg.png" alt="MoniMix Delights" width="80" height="30">
    <h4>Welcome Back "<?php echo "<b>" . $username . "</b>" ?>"!</h4>
</div>