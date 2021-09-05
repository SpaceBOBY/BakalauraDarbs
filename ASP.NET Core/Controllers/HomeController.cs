using AsynchronousTesting.Models;
using Microsoft.AspNetCore.Mvc;
using RandomNameGen;
using System;
using System.Collections.Generic;
using System.Threading.Tasks;
using Asynchronous.NET.Testing;
using System.IO;
using System.Linq;

namespace AsynchronousTesting.Controllers
{
    [ApiController]
    [Route("[action]")]
    public class HomeController : ControllerBase
    {
        public AppDb Db { get; }

        public HomeController(AppDb db)
        {
            Db = db;
        }

        [HttpGet, ActionName("FillBigTable")]
        public async Task<IActionResult> FillBigTable()
        {
            await Db.Connection.OpenAsync();

            var names = new RandomName(new Random(DateTime.Now.Second)).RandomNames(100001, 0);
            for (int i = 2; i <= 100000; i++)
            {
                var rnd = new Random();
                var body = new Test(Db);
                body.Name = names[i];
                body.Age = rnd.Next(16, 52);
                await body.InsertAsyncBig();
            }

            return new OkResult();
        }

        [HttpGet, ActionName("FillSmallTable")]
        public async Task<IActionResult> FillSmallTable()
        {
            await Db.Connection.OpenAsync();

            var names = new RandomName(new Random(DateTime.Now.Second)).RandomNames(10001, 0);
            for (int i = 2; i <= 10000; i++)
            {
                var rnd = new Random();
                var body = new Test(Db);
                body.Name = names[i];
                body.Age = rnd.Next(16, 52);
                await body.InsertAsyncSmall();
            }

            return new OkResult();
        }

        [HttpGet, ActionName("SimpleGet")]
        public async Task<IActionResult> SimpleGet()
        {
            var result = new
            {
                HealthStatus = "Web service is working"
            };

            return Ok(result);
        }

        [HttpGet, ActionName("GetAllFromBig")]
        public async Task<IActionResult> GetAllBig()
        {
            await Db.Connection.OpenAsync();
            var query = new TestQuery(Db);
            var result = await query.GetAllBigAsync();
            return new OkObjectResult(result);
        }

        [HttpGet, ActionName("GetAllFromSmall")]
        public async Task<IActionResult> GetAllSmall()
        {
            await Db.Connection.OpenAsync();
            var query = new TestQuery(Db);
            var result = await query.GetAllSmallAsync();
            return new OkObjectResult(result);
        }

        [HttpDelete("{id}"), ActionName("Delete")]
        public async Task<IActionResult> DeleteOne(int id)
        {
            await Db.Connection.OpenAsync();
            var query = new TestQuery(Db);
            var result = await query.FindOneAsync(id);
            if (result is null)
            {
                var response = new
                {
                    HealthStatus = "Web service is working"
                };
                return Ok(response);
            }
                
            await result.DeleteAsync();
            return new OkResult();
        }

        [HttpPost, ActionName("Insert")]
        public async Task<IActionResult> InsertIntoTable([FromBody] Test body)
        {
            await Db.Connection.OpenAsync();
            body.Db = Db;
            await body.InsertAsync();
            return new OkObjectResult(body);
        }

        [HttpPut("{id}"), ActionName("Update")]
        public async Task<IActionResult> PutOne(int id, [FromBody] Test body)
        {
            await Db.Connection.OpenAsync();
            var query = new TestQuery(Db);
            var result = await query.FindOneAsync(id);
            if (result is null)
                return new NotFoundResult();
            result.Name = body.Name;
            result.Age = body.Age;
            await result.UpdateAsync();
            return new OkObjectResult(result);
        }

        [HttpGet, ActionName("Download")]
        public async Task<IActionResult> Download()
        {
            var imageUrls = new List<string>
            {
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300",
                "https://picsum.photos/200/300"
            };
            var results = new List<byte[]>();

            await foreach(var image in SyncProducts(imageUrls))
            {
                results.Add(image);
            }

            var output = new MemoryStream(results[0]);
            return File(output, "image/jpeg");
        }

        private static async IAsyncEnumerable<byte[]> SyncProducts(List<string> imageUrls)
        {
            foreach (var image in imageUrls)
            {
                yield return await Downloader.DownloadFileAsync(image);
            }
        }
    }
}
