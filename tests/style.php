<style>
    body{
        margin:0;
        padding: 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
    }
        .block {

            padding: 5px;
            margin: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            display:none;
        }
        .block.show{
            display: block;
        }

        .caption {
            border-bottom: 1px solid gray;
            width: 98%;
            padding: 3px;
            margin: 3px;
        }
        h4:hover{
            cursor: pointer;
            font-weight: 600;
            text-decoration: underline;
        }

        .grid {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto auto auto;
            gap: 0px;
        }

        .grid p {
            font-size: x-small;
            padding: 3px;
            margin: 0px;
            border: 1px solid gray;
        }
        h1{
            text-align: center;
            text-justify: distribute;
        }
        nav{
            margin:0;
            padding:0;
            width: 100%;
            background: #459283;
        }
        nav ul{
            margin:0;
            padding:0;
             gap:2px;
             list-style:none;
             display: grid;
            grid-template-columns: auto auto auto auto auto auto auto ;
            
        }
        nav a{
            text-decoration: none;
            color:white
        } 
        nav a:hover{
            text-decoration: underline;
            font-weight: 600;
        } 
        nav a:overed{
            color:white
        }
    </style>